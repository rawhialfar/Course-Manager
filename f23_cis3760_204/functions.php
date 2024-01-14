<?php
function run_query($query)
{
    #get connection
    global $connection;

    #execeute queries on db from $conn
    try {
        $run = mysqli_query($connection, $query);
    } catch(Exception $e) {
        $run['error'] = "Query execution failed: " . $connection->error;
        http_response_code(404); // Internal service error
        return $run;
    }

    if ($run) {
        $res = mysqli_fetch_all($run, MYSQLI_ASSOC);
        #display results
        return $res;
    } else {
        http_response_code(404); // Not found
        return array("error" => "No entry was found in the database");
    }
}


// GET FUNCTIONS


function getCourseDescription($id)
{
    $first = 0;
    $query = "SELECT * FROM Course";

    foreach ($id as $courseID) {
        if ($first == 0) {
            $query .= " WHERE courseID = '$courseID'";
            $first = 1;
        } else
            $query .= " OR courseID = '$courseID'";
    }

    #run function in runQueries.php
    $res = run_query($query);
    if ($res)
        return json_encode($res);
    else
        return NULL;
}

function getCoursePrerequisites($id)
{
    global $connection;
    $first = 0;
    $query = "SELECT Course.courseID, prerequisite
            FROM Course
            RIGHT JOIN Prerequisite
            ON Course.courseID = Prerequisite.courseID";

    foreach ($id as $courseID) {
        if ($first == 0) {
            $query .= " where Course.courseID = '$courseID'";
            $first = 1;
        } else
            $query .= " or Course.courseID = '$courseID'";
    }

    #run function in runQueries.php
    try {
        $res = run_query($query);
    } catch(Exception $e) {
        $res['error'] = "Query execution failed: " . $connection->error;
        http_response_code(404); // Internal service error
        return $res;
    }

    if ($res)
        return json_encode($res);
    else
        return NULL;
}

function getAvailableCourses($prereq_list)
{
    global $connection;
    if (  ($prereq_list[0] != "" ) ){

        $first = 0;
        $query = "SELECT DISTINCT courseID, count(courseID) as prereqs FROM Prerequisite";


        foreach ($prereq_list as $prereq) {
            if ($first == 0) {
                $query .= " where prerequisite like '%$prereq%'";
                $first = 1;
            } else {
                $query .= " or prerequisite like '%$prereq%'";
            }
        }

        $query .= " group by courseID";
        $res = run_query($query);

        $available_courses = [];

        foreach ($res as $course) {
            $courseID = $course['courseID'];

            //get total number of prereqs for a course
            $query2 = "SELECT count(prerequisite) as prereqs
                        FROM Prerequisite 
                        WHERE courseID =  '$courseID'";

            $num_prereqs = run_query($query2);

            //add course to available courses finish all prereqs were met
            foreach ($num_prereqs as $number) {
                if ($course['prereqs'] == $number['prereqs']) {
                    $found['courseID'] = $courseID;
                    array_push($available_courses, $found);
                }
            }
        }
    }

    else{
       
        $query3 = "SELECT DISTINCT Course.courseID from Course
                where Course.courseID not in (SELECT DISTINCT Prerequisite.courseID from Prerequisite)";

        $no_prereqs = run_query($query3);
        $available_courses = [];

        foreach ($no_prereqs as $course){
            $courseID = $course['courseID'];
            $found['courseID'] = $courseID;
            array_push($available_courses, $found);
        }
    }

    if ($available_courses)
        return json_encode($available_courses);
    else
        return NULL;
}

function getSubjects($id)
{
    global $connection;
    $first = 0;
    $query = "SELECT courseID FROM Course";

    foreach ($id as $subject) {
        if ($first == 0) {
            $query .= " WHERE courseID like '$subject%'";
            $first = 1;
        } else
            $query .= " or courseID like '$subject%'";
    }

    #run function in runQueries.php

    $res = run_query($query);
    if ($res)
        return json_encode($res);
    else
        return NULL;
}

function semesterCourses($id)
{
    global $connection;
    $query = "SELECT courseID FROM Course where semester like '%$id%'";

    #run function in runQueries.php
    $res = run_query($query);
    $list = [];
    if ($res){
        foreach ($res as $row) {
            array_push($list, $row['courseID']);
        }

        return json_encode($list);
    }
    else
        return NULL;
}

function getFinshedCourses($id)
{
    global $connection;
    $first = 0;
    $query = "SELECT * 
    FROM Student
    RIGHT JOIN FinishedCourse
    ON Student.studentID = FinishedCourse.studentID";

    foreach ($id as $userID) {
        if ($first == 0) {
            $query .= " where Student.studentID = $userID";
            $first = 1;
        } else
            $query .= " or Student.studentID = $userID";
    }

    #run function in runQueries.php
    $res = run_query($query);
    if ($res)
        return json_encode($res);
    else
        return NULL;
}

function GetAvailableCoursesStudentID($id)
{
    #get student finished courses
    $res = json_decode(getFinshedCourses($id));
    $courses = [];
    $idx = 0;

    //store the list of courses
    foreach ($res as $row) {
        $courses[$idx] = $row->courseID;
        $idx = $idx + 1;
    }

    return  getAvailableCourses($courses);
}

// POST FUNCTIONS

function addCourse($courseName, $courseID, $credit, $semester, $description) {
    global $connection;

    $query = "INSERT INTO Course (course_name, courseID, credit, semester, description)
            VALUES ('$courseName',  '$courseID', $credit, '$semester', '$description')";

    $res = array();
    try {
        if ($connection->query($query) === TRUE) {
            $res['message'] = "$courseID was added to the database successfully";
            http_response_code(201);
        } 
    }
    catch(Exception $e) {
        $res['error'] = "Query execution failed: " . $connection->error;
        http_response_code(404); // Internal service error
        return $res;
    }

    return $res;
}

function addFinishedCourse($courseName, $studentID, $grade) {
    global $connection;

    $query = "INSERT INTO FinishedCourse (courseID, grade, studentID) VALUES ('$courseName', $grade, $studentID)";

    $res = array();
    try {
        if ($connection->query($query) === TRUE) {
            $res['message'] = "$courseName was added to the database successfully";
            http_response_code(201);
        }
    }
    catch(Exception $e) {
        $res['error'] = "Query execution failed: " . $connection->error;
        http_response_code(404); // Internal service error
        return $res;
    }

    return $res;
}

function addStudent($studentID) {
    global $connection;

    $query = "INSERT INTO Student (studentID) VALUES ($studentID)";

    $res = array();

    try {
        if ($connection->query($query) === TRUE) {
            $res['message'] = "$studentID was added to the database successfully";
            http_response_code(201);
        }
    }
    catch(Exception $e) {
        $res['error'] = "Query execution failed: " . $connection->error;
        http_response_code(404); // Internal service error
    }

    return $res;
}

// PUT FUNCTIONS

function modifyCourse($courseName, $courseID, $credit, $semester, $description)
{
    global $connection;
    $res = array();

    $query = "UPDATE Course
              SET credit = $credit,
                  semester = '$semester',
                  description = '$description', 
                  course_name = '$courseName'
              WHERE courseID = '$courseID'";

    try {
        $connection->query($query);
        $res['message'] = 'Course record updated successfully';
        http_response_code(201);
    } catch (Exception $e) {
        $res['error'] = "Query execution failed: " . $connection->error;
        http_response_code(404); // Internal service error
    }

    return $res;
}


function modifyFinishedCourse($courseName, $studentID, $grade)
{
    global $connection;
    $res = array();

    $query = "UPDATE FinishedCourse SET grade = $grade, studentID = $studentID WHERE courseID = '$courseName'";

    try {
        $connection->query($query);
        $res['message'] = "Finished course record updated successfully";
        http_response_code(201);
    } catch (Exception $e) {
        $res['error'] = "Query execution failed: " . $connection->error;
        http_response_code(404);
    }

    return $res;
}

function deleteFinishedCourse($courseID, $studentID) {
    global $connection;
    $res = array();

    $query = "DELETE FROM FinishedCourse WHERE courseID = '$courseID' AND studentID = '$studentID'";
    
    try {
        $connection->query($query);
        echo json_encode(["message" => "Deleted Course " . $courseID . " from " . $studentID . " in FinishedCourse table"]);
        http_response_code(200); // Request Approved
    } catch (Exception $e) {
        echo json_encode(["error" => "Query execution failed: " . $connection->error]);
        http_response_code(404); // 404 Error
    }
    
    return $res;
    }
