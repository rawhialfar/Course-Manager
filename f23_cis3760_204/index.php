<!DOCTYPE html>
<html>

<head>
    <title>Course Manager</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="src/js/loader.js"></script>
    <link rel="stylesheet" type="text/css" href="src/style/style.css">
    <link rel="stylesheet" media="screen and (max-width: 1280px)" type="text/css" href="src/style/mobile.css">
    <link rel="shortcut icon" type="image/svg" href="src/img/logo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- Navigation Bar -->
    <header class="header">
        <a href="#home" style="height:100%;display:flex;align-items:center;">
            <img class="logo" src="src/img/logo.svg">
        </a>
        <div class="navItems">
            <a href="#home">Home</a>
            <a href="#description" class="anchor">Description</a>
            <a href="#download">Download</a>
            <a href="#about">About</a>
            <a href="Course_Search.html">Course Search</a>
            <a href="Course_Tree.html">Course Tree</a>
            <a href="src/img/db_doc.svg">Database</a>
            <a href="API_documentation.html">API Documentation</a>
        </div>

        <div class="navbar">
            <input id="menu__toggle" type="checkbox" />
            <label class="menu__btn" for="menu__toggle">
            <span></span>
            </label>

            <ul class="menu__box">
                    <li><a class="menu__item" href="#home">Home</a></li>
                    <li><a class="menu__item"href="#description" class="anchor">Description</a></li>
                    <li><a class="menu__item"href="#download">Download</a></li>
                    <li><a class="menu__item"href="#about">About</a></li>
                    <li><a class="menu__item"href="Course_Search.html">Course Search</a></li>
                    <li><a class="menu__item"href="Course_Tree.html">Course Tree</a></li>
                    <li><a class="menu__item"href="db_doc.svg">Database</a></li>
                    <li><a class="menu__item"href="API_documentation.html">API Documentation</a></li>
            </ul>
        </div>
    </header>
    <!-- homepage -->
    <section style="color: #d3d3d3;" class="homepage" id="home">
        <h1 class="homepageText">Course Manager</h1>
        <h1 class="homepageSecondaryText">By Group 204</h1>
    </section>

    <section id="slogan1">
        <div class="slogan">
            <h1 class="sloganText">
                Course Management Done Right!
            </h1>
            <img class="slogan1Image" src="src/img/Education.svg">
        </div>
    </section>

    <section id="slogan2">
        <div class="slogan">
            <h1 class="sloganText2">
                Find courses that are available for you!
            </h1>
            <img class="slogan2Image" src="src/img/Spreadsheet.svg">
            
        </div>
    </section>



    <section id="description" class="contentSection">
        <div class="sectionHeader">
            <h2 class="mainHeading">
                Description
            </h2>
        </div>

        <div class="descriptionSections">
            <h3 class="subHeading">Overview</h3>
            <div class="imageContainer">
                <img src="Screenshots/Blank_Overview.png" alt="" class="contentImage">
            </div>
            <div class="textContainer">
                <p>
                    Course Manager displays all available courses the user can take for a given semester after the user
                    has entered their course information, the semester they are registering for, and the specific subject
                    area of the courses they want to look for.
                </p>
            </div>

            <div class="textContainer; textContainer2" class="textContainer2">
                <p>
                    Course manager is operated through the use of three main buttons
                </p>
            </div>
        </div>


        <div class="descriptionSections">
            <h3 class="subHeading">1. Enter Course Button</h3>

            <div class="textContainer">
                <p>
                    When the Enter Course button is pressed, a user form will be displayed for their course information
                </p>
            </div>

            <div class="imageContainer">
                <img src="gifs/Click_Enter_Courses.gif" alt="" class="contentImage">
            </div>

            <div class="textContainer">
                <p>
                    This form allows the user to enter and save their course information to the spreadsheet.
                    The form has an example showing the user how their information should be entered. Along with
                    their course information the user will also specify which semester's courses they are looking for.
                </p>
            </div>

            <h4 class="subSubHeading">Course Information Form</h4>

            <div class="imageContainer">
                <img src="Screenshots/User_Form.png" alt="" class="contentImage2">
            </div>

            <div class="textContainer">
                <p>Once the user is satisfied with their information, they can press the add course button, which will save
                    their information and adds it to the appropriate fields in the spreadsheet:
                </p>
            </div>
            <ol class="listContent">
                <li>Course Name</li>
                <li>Weight</li>
                <li>Grade</li>
                <li>Current Semester</li>
            </ol>

            <div class="imageContainer">
                <img src="Screenshots/Data_Entered.png" alt="" class="contentImage">
            </div>
        </div>
        <hr>

        <div class="descriptionSections">
            <h3 class="subHeading">2. Get Eligible Course Button</h3>

            <div class="textContainer">
                <p>
                    When the get Eligible Courses button is pressed, a user form will be displayed to get the user's
                    desired subject area
                </p>
            </div>
            <div class="imageContainer">
                <img src="gifs/Click_Eligible_Courses.gif" alt="" class="contentImage">
            </div>

            <h4 class="subSubHeading">Retrieve Courses Form</h4>

            <div class="imageContainer">
                <img src="Screenshots/Retrieve_Courses.png" alt="" style="width: 30%;">
            </div>

            <div class="textContainer">
                <p>
                    When the user enters in the subject area, it must be in all Upper Case to be considered valid.
                    Once the user is satisfied with the subject area, they can press the retrieve courses button.

                    Once course manager is finished running, it will display all the courses the user can take in their
                    upcoming semester under that subject area in the Eligible Course course field
                </p>
            </div>

            <div class="imageContainer">
                <img src="Screenshots/Completed_Search.png" alt="" class="contentImage">
            </div>
        </div>

        <hr>

        <div class="descriptionSections">
            <h3 class="subHeading">3. Clear Table Button</h3>

            <div class="textContainer">
                <p>
                    The clear table button allows clears the tables of all the previous entered courses information and
                    the list of eligible courses, allowing the user to easily enter new course information.
                </p>
            </div>

            <div class="imageContainer">
                <img src="gifs/Click_Clear_Table.gif" alt="" class="contentImage">
            </div>


            <h3 class="subHeading">Course Prerequisites</h3>

            <div class="textContainer">
                <p>
                    Initially all courses, with their relevant prerequisites, as well as the semester(s) they are
                    taught in, were automatically parsed before being stored in the AllCourseData sheet. This information
                    is stored using the following format:
                </p>
            </div>
            <ol class="listContent">
                <li>Column one always contains the course name</li>
                <li>The associated prerequisites (if any) are store afterwards, each within separate cells in the same row</li>
                <li>After all prerequisites are stored, the semesters in which that course is offered will be stored in separate cells</li>
            </ol>

            <div class="imageContainer">
                <img src="Screenshots/Course_Data_Format.png" alt="" class="contentImage">
            </div>
        </div>

    </section>

    <section id="download">
        <div class="slogan">
            <div class="downloadText">
                <h1>
                    Download the excel file!
                </h1>
                <a href="src/Course_Search_VBA.xlsm" Download="Course_Search_VBA.xlsm">
                    <button class="button">
                        <img src="src/img/downloadIcon.svg" class="downloadIcon">
                    </button>
                </a>
            </div>
            <img class="downloadImage" src="src/img/download.svg">
        </div>
    </section>

    <section id="WalkthroughVideo">
        <div class="sectionHeader" style="padding-bottom:1em;">
            <h2 class="mainHeading">
                Walkthrough Excel Video
            </h2>
        </div>
        <video width=100% height=auto controls>
            <source src="src/img/Excel Walkthrough Video.mp4" type="video/mp4">
            </source>
        </video>
    </section>

    <section id="about">
        <div class="aboutContainer">
            <div class="sectionHeader" style="padding-bottom:1em;padding-top:0;">
                <h2 class="mainHeading">
                    About
                </h2>
            </div>
            <div class="teamMembersContainer">
                <div class="taha teamMember">
                    <img style="width:50px" src="src/img/person.svg">
                    <a class="name" href="javascript:void(0);" onclick="loadDynamicContent('taha_script.php', 'nameClickCounter')">Taha Memon</a>
                    <p>Hi, my name is Taha Memon. I'm part of the Computer Science Co-op program at the University of Guelph. Some of the courses I've enjoyed the most at Guelph have been CIS*3110 and CIS*2030</p>
                    <div id="nameClickCounter"></div>
                </div>
                <div class="rawhi teamMember">
                    <img style="width:50px" src="src/img/person.svg">
                    <style>
                        #rollDice {
                            display: none;
                        }
                    </style>
                    <a class="name" href="javascript:void(0);" onclick="showForm()">Rawhi Alfar</a>
                    <div id="rollDice">

                        <h1>Dice Roller</h1>

                        <form id="diceForm">
                            <input id="diceFormButton" type="button" value="Roll Dice" onclick="loadDynamicContent('rawhi_script.php', 'diceResult')">
                        </form>

                        <div id="diceResult">
                        </div>
                    </div>
                    <script>
                        function showForm() {
                            var form = document.getElementById("rollDice");
                            form.style.display = "block";
                        }
                    </script>
                    <hr>
                    <p id="rawhi-desc">
                        Hello, I am Rawhi Alfar, a 4th year Software Engineering student at the University of Guelph.
                        I am also in the coop program and will be taking my 3rd coop job next semester.
                        For my PHP script I built a mini dice rolling minigame where you click a button to roll a six-sided dice and it will roll a number between 1 and 6 and if you roll a 6 you will be shown a congratulations message.  
                    </p> 
                </div>
                <div class="shane teamMember">
                    <img style="width:50px" src="src/img/person.svg">
                    <a class="name" href="javascript:void(0);">Shane Skinner</a>
                    <div id=""></div>
                    <p>
                        <?php
                        $array = array('green', 'red', 'blue', 'yellow', 'orange', 'gray', 'white', 'pink');
                        $clr =  $array[array_rand($array)];
                        $description = "I am Shane Skiner, a 4th year student at the University of Guelph. I am
                        majoring in Computer Science, and have almost completed a minor in maths. I am also in the Co-op
                        program where I have completed three co-op work terms so far and will be taking my final 2 in the
                        coming Winter 2024 and Summer 2024";

                        echo '<div style="color: ' . $clr . '">' . $description . '</div>';
                        ?>
                    </p>
                </div>
                <div class="ramroop teamMember">
                    <img style="width:50px" src="src/img/person.svg">
                    <a class="name" href="javascript:void(0);" onclick="changeRectColor('ramroop_script.php', 'colorRect')">Ramroop Singh</a>
                    <div id=""></div>
                    <p>
                        Hello, my name is Ramroop Singh! I'm a 4th year student in Computer Science. 
                        I love frontend and I've started to dive into cloud computing. Outside of programming 
                        I love playing basketball and Super Smash Bros.
                    </p>
                    <br>
                    <p>Click on my name!</p>
                    <div class="colorRect" style="margin: 10px;height: 100px;width: 100px;background-color: white;border-radius: 10px;"></div>
                </div>
                <?php
                $timestampMessage = "Show timestamp";

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $timestampMessage = "Current Timestamp: " . date("Y-m-d H:i:s");
                }
                ?>
                <div class="shuang teamMember" id="team-section">
                    <img style="width:50px" src="src/img/person.svg">
                    <a class="name" href="javascript:void(0);">Shuang Liang</a>
                    <div id=""></div>
                    <form method="post" action="#team-section">
                        <p>
                            <?php echo $timestampMessage; ?>
                        </p>
                        <button class="shuangFormButton" type="submit">Click</button>
                    </form>
                </div>
                <div class="daniel teamMember">
                    <img style="width:50px" src="src/img/person.svg">
                    <a class="name" href="javascript:void(0);" onclick="loadDynamicContent('daniel_script.php', 'randomPasswordGenerator')">Daniel Errol Santiago</a>
                    <div id="randomPasswordGenerator"></div>
                    <p>
                        Hi, I'm Daniel Santiago, a 4th year student at the University of Guelph. I am in the Software Engineering program. My hobbies include going to the gym, playing basketball, and playing video games. I enjoy shows such as One Piece, The Office, and Brooklyn Nine-Nine.
                    </p>
                </div>
            </div>
        </div>
    </section>
</body>

</html>