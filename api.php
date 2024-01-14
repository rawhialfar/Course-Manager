<?php
require 'config.php';
include_once 'functions.php';

header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case  'OPTIONS':
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, PUT, OPTIONS');
        header('Access-Control-Max-Age: 1728000');
        header("Content-Length: 0");
        break;
    case 'POST':
        //get JSON from the request body
        parse_str(file_get_contents('php://input'), $getData);

        if ($getData['action']) {
            $key = $getData['action'];
        } else {
            echo "No action key";
            return;
        }

        // GET functions
        if ($key == 'getDescription') {
            $data_arr = array_map('trim', explode(',',  $getData[$key]));
            $res = getCourseDescription($data_arr);
            print_r($res);
            return $res;
        } else if ($key == 'getPrerequisites') {
            $data_arr = array_map('trim', explode(',',  $getData[$key]));
            $res = getCoursePrerequisites($data_arr);
            print_r($res);
            return $res;
        } else if ($key == 'getSubjects') {
            $data_arr = array_map('trim', explode(',',  $getData[$key]));
            $res = getSubjects($data_arr);
            print_r($res);
            return $res;
        } else if ($key == 'getFinishedCourses') {
            $data_arr = array_map('trim', explode(',',  $getData[$key]));
            $res = getFinshedCourses($data_arr);
            print_r($res);
            return $res;
        } else if ($key == 'availableCourses') {
            $data_arr = array_map('trim', explode(',',  $getData[$key]));
            $res = getAvailableCourses($data_arr);
            print_r($res);
            return $res;
        } else if ($key == 'availableCoursesStudentID') {
            $data_arr = array_map('trim', explode(',',  $getData[$key]));
            $res = GetAvailableCoursesStudentID($data_arr);
            print_r($res);
            return $res;
        } else if ($key == 'semesterCourses') {
            $data_val = array_map('trim', explode(',',  $getData[$key]));
            $res = semesterCourses($data_val[0]);
            print_r($res);
            return $res;
        }else {
            $res['error'] = 'Invalid action';
            http_response_code(400); // Bad request
        }

        break;


    case 'PUT':
        parse_str(file_get_contents('php://input'), $putData);

        if (isset($putData['action'])) {
            $action = $putData['action'];

            if ($action === 'modifyCourse') {
                $res = modifyCourse(
                    $putData['courseName'],
                    $putData['courseID'],
                    $putData['credit'],
                    $putData['semester'],
                    $putData['description']
                );
            } elseif ($action === 'modifyFinishedCourse') {
                $res = modifyFinishedCourse(
                    $putData['modifyFinishedCourseName'],
                    $putData['modifyFinishedCourseStudent'],
                    $putData['modifyFinishedCourseGrade']
                );
            } else {
                $res['error'] = 'Invalid action or missing action parameter';
                http_response_code(400); // Bad request
            }
        } else {
            $res['error'] = 'Action parameter missing';
            http_response_code(400); // Bad request
        }

        echo json_encode($res);
        break;

    case 'POSTqq2233':
        // POST functions
        // Check if a valid action is specified
        parse_str(file_get_contents('php://input'), $postData);

        $res = array();
        if (isset($postData['action'])) {
            $action = $postData['action'];
            if ($action === 'addCourse') {
                $res = addCourse($postData['courseName'], $postData['courseID'], $postData['credit'], $postData['semester'], $postData['description']);
            } elseif ($action === 'addFinishedCourse') {
                $res = addFinishedCourse($postData['courseName'], $postData['studentID'], $postData['grade']);
            } elseif ($action === 'addStudent') {
                $res = addStudent($postData['studentID']);
            } else {
                $res['error'] = 'Invalid action or missing action parameter';
                http_response_code(400); // Bad request
            }
        } else {
            $res['error'] = 'Action parameter missing';
            http_response_code(400); // Bad request
        }

        echo json_encode($res);
        break;

    case 'DELETE':
        // DELETE functions
        parse_str(file_get_contents('php://input'), $putData);

        if (isset($putData['action'])) {
            $action = $putData['action'];
            if ($action === 'deleteFinishedCourse') {
                $res = deleteFinishedCourse($putData['courseID'], $putData['studentID']);
            }
        } else {
            $res['error'] = 'Action parameter missing';
            http_response_code(400); // Bad request
        }


        include 'delete_requests.php';
        break;

    default:
        http_response_code(405);
        header('Allow: GET, PUT, POST, DELETE');
}
