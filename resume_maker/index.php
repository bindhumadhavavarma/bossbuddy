<?php
session_start();
?>
<html>

<head>
    <title>Boss Buddy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/e09a89de7b.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="resumestyles.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
    <link rel="icon" href="../images/logo.png">
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top navbar-light">
        <a class="navbar-brand" href="../">
            <img src="../images/logo.png" width="43" height="40" class="d-inline-block align-top" alt="">
            <span class="brand">Boss <span>Buddy</span></span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a id="navlink" class="nav-link" href="../">Home</a>
                </li>
                <li class="nav-item active" id="active">
                    <a id="navlink" class="nav-link" href="#">WorkStation</a>
                </li>
                <li class="nav-item">
                    <a id="navlink" class="nav-link" href="../internships/">Internships</a>
                </li>
                <li class="nav-item">
                    <a id="navlink" class="nav-link" href="../freelancing">Freelancing</a>
                </li>

            </ul>
            <div class="form-inline my-2 my-lg-0">
                <?php
                if (!isset($_SESSION['logged'])) {
                    echo '
                        <a type="button" id="navlink" class="nav-link" data-toggle="modal" data-target="#LoginModal">Login</a>
                        <a type="button" id="navlink" class="nav-link" data-toggle="modal" data-target="#SignupModal">Sign Up</a>';
                } else {
                    echo '<a id="navlink" class="nav-link" href="#">' . $_SESSION['logged'] . '</a>
                    <a id="navlink" class="nav-link" href="../APIs/logout.php">Logout</a>';
                }
                ?>
            </div>
        </div>
    </nav>


    <div class="row">
        <nav id="navbarSupportedContent" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="sidebar-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link " href="../workstation/">
                            Agenda Planner
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link active" href="#">
                            Resume Maker
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../bossbuddychat/">
                            Boss Buddy Chat
                        </a>
                    </li>

                </ul>
                <hr>
            </div>
        </nav>

        <div id="maincontainer" class="col-md-9 ml-sm-auto col-lg-10" style="width: 100%;padding-right:0;">
            <div id="tooltip">
                <?php
                if (isset($_SESSION['error'])) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $_SESSION['error'] .
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                    unset($_SESSION['error']);
                }
                if (isset($_SESSION['success'])) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'
                        . $_SESSION['success'] .
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                    unset($_SESSION['success']);
                }
                ?>
            </div>
            <div id="formcontainer">
            <div style="width: 100%;">
                    <div style="margin: 0 0 0 auto;width:fit-content;">
                        <button class="btn btn-primary" style="margin: 0 auto;" onclick="return showPreview()">Preview</button>
                    </div>

                </div>
                <form action="">
                    <h2>Personal Info</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">Name :</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="email">Email :</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="phone">Phone :</label>
                            <input type="number" name="phone" id="phone" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="city">City :</label>
                            <input type="text" name="city" id="city" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="state">State :</label>
                            <input type="text" name="state" id="state" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="website">Website :</label>
                            <input type="text" name="website" id="website" class="form-control">
                        </div>
                    </div>
                    <div class="education" id="educationSection">
                        <h2>Education</h2>

                    </div>
                    <button class="btn btn-primary" onclick="return addEducation()" style="margin-top: 10px;">Add Education</button>
                    <div id="skillSection" style="margin-top: 15px;">
                        <h2>Skills</h2>

                    </div>
                    <button class="btn btn-primary" onclick="return addSkill()" style="margin-top: 10px;">Add Skill</button>
                    <div id="projectsSection" style="margin-top: 15px;">
                        <h2>Projects</h2>

                    </div>
                    <button class="btn btn-primary" onclick="return addProject()" style="margin-top: 10px;">Add Project</button>
                    <div id="jobsSection" style="margin-top: 15px;">
                        <h2>Jobs/Internships</h2>

                    </div>
                    <button class="btn btn-primary" onclick="return addJob()" style="margin-top: 10px;">Add Job/Internship</button>
                    <div id="courseSection" style="margin-top: 15px;">
                        <h2>Trainings/Courses</h2>

                    </div>
                    <button class="btn btn-primary" onclick="return addCourse()" style="margin-top: 10px;">Add Training/Course</button>
                </form>
                


            </div>
            <div id="previewContainer" class="hidden" style="background-color: white;">
                <button class="btn btn-primary" onclick="return showForm()">Go Back</button>
                <button class="btn btn-primary" onclick="return downloadResume()">Download</button>
                <div id="mainResume">
                    <div class="row">
                        <div class="col-sm-7">
                            <h1>Bindhu Madhava Varma C</h1>
                        </div>
                        <div class="col-sm-5" style="text-align: right;">
                            <div>bindhu.19bcd7116@vitap.ac.in</div>
                            <div>+91 6309298166</div>
                            <div>thullur, Amaravati</div>
                        </div>
                        <div style="background-color: #15173d;height:9px;width:100%"></div>


                    </div>
                    <div class="row" style="margin-top: 25px;">
                        <div class="col-sm-3">
                            <h4>Education</h4>
                        </div>
                        <div class="col-sm-9">
                            <div style="margin-bottom: 20px;">
                                <h4>Bachelor of Technology (B.Tech), Computer Science Specialization In Data Analytics</h4>
                                <div>Vellore Institute Of Technology Amaravati AP</div>
                                <div>2023</div>
                                <div>CGPA : 9.28/10</div>
                            </div>
                            <div style="margin-bottom: 20px;">
                                <h4>Bachelor of Technology (B.Tech), Computer Science Specialization In Data Analytics</h4>
                                <div>Vellore Institute Of Technology Amaravati AP</div>
                                <div>2023</div>
                                <div>CGPA : 9.28/10</div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row" style="margin-top: 25px;">
                        <div class="col-sm-3">
                            <h4>Skills</h4>
                        </div>
                        <div class="col-sm-9 row">
                            <div style="margin-bottom: 20px;width:50%;">
                                <h4>Java</h4>
                                <div>Experienced</div>
                            </div>
                            <div style="margin-bottom: 20px;width:50%;">
                                <h4>Java</h4>
                                <div>Intermediate</div>
                            </div>
                            <div style="margin-bottom: 20px;width:50%;">
                                <h4>Java</h4>
                                <div>Experienced</div>
                            </div>
                            <div style="margin-bottom: 20px;width:50%;">
                                <h4>Java</h4>
                                <div>Intermediate</div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row" style="margin-top: 25px;">
                        <div class="col-sm-3">
                            <h4>Projects</h4>
                        </div>
                        <div class="col-sm-9">
                            <div style="margin-bottom: 20px;">
                                <h4>Secure chat</h4>
                                <div>This is a chatting website. The messages sent through this website are encrypted
                                    using AES and DES algorithms. I wrote my own code in PHP to implement these
                                    algorithms as it was a part of my college course named Introduction to
                                    Cryptography</div>
                            </div>
                            <div style="margin-bottom: 20px;">
                                <h4>Secure chat</h4>
                                <div>This is a chatting website. The messages sent through this website are encrypted
                                    using AES and DES algorithms. I wrote my own code in PHP to implement these
                                    algorithms as it was a part of my college course named Introduction to
                                    Cryptography</div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row" style="margin-top: 25px;">
                        <div class="col-sm-3">
                            <h4>Jobs/Internships</h4>
                        </div>
                        <div class="col-sm-9">
                            <div style="margin-bottom: 20px;">
                                <h4>Web Developer</h4>
                                <div>SEDS VITAP</div>
                                <div>21/12/2020 - 12/5/2021</div>
                            </div>
                            <div style="margin-bottom: 20px;">
                                <h4>Web Developer</h4>
                                <div>SEDS VITAP</div>
                                <div>21/12/2020 - 12/5/2021</div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row" style="margin-top: 25px;">
                        <div class="col-sm-3">
                            <h4>Trainings/Courses</h4>
                        </div>
                        <div class="col-sm-9">
                            <div style="margin-bottom: 20px;">
                                <h4>HTML, CSS, JS</h4>
                                <div>Coursera</div>
                                <div>21/12/2020</div>
                                <div>certificate link : bindhumadhavavarma.github.io</div>
                            </div>
                            <div style="margin-bottom: 20px;">
                            <h4>HTML, CSS, JS</h4>
                                <div>Coursera</div>
                                <div>21/12/2020</div>
                                <div>certificate link : bindhumadhavavarma.github.io</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Login Modal -->
    <div class="modal fade" id="LoginModal" tabindex="-1" aria-labelledby="LoginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body modalbody">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3>Login</h3>
                    <div id="message1"></div>
                    <form onsubmit="return login();" id="loginform">
                        <div id="msg"></div>
                        <label for="Username">Username</label>
                        <input class="form-control" type="text" name="username">
                        <label for="Password">Password</label>
                        <input type="password" class="form-control" name="password">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!--Signup Modal -->
    <div class="modal fade" id="SignupModal" tabindex="-1" aria-labelledby="SignupModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body modalbody">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3>Sign Up</h3>
                    <div name="signupform">


                        <div id="message">

                        </div>
                        <form onsubmit="return signup();" id="signupform">

                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password">
                            <label for="confpass">Confirm Password:</label>
                            <input type="password" class="form-control" name="confpass">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Sign Up</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <script src="../js/jquery-1.11.3.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/html2pdf.bundle.min.js"></script>
    <script src="resumeScripts.js"></script>
</body>

</html>