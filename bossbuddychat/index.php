<?php
session_start();
?>
<html>

<head>
    <title>Boss Buddy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script rel="preconnect" src="https://kit.fontawesome.com/e09a89de7b.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
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
                        <a class="nav-link" href="../resume_maker/">
                            Resume Maker
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
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
            <div class="container-fluid" style="width: 100%;">
                <?php
                if (!isset($_SESSION['logged'])) {
                    echo '
                        <div style="margin:20vh auto;width:fit-content;"><h1>Please login to use this feature.</h1></div>
                    ';
                }
                else{
                    echo '
                    <div class="container-fluid row" style="margin: 0;">
                    <div class="app row">
                        <div class="calendar col-lg-7">
                            <div class="contacts-layout" id="contact-body">
                                <h2 style="display: inline;max-width:fit-content">Contacts</h2>
                                <button onclick="return refreshContacts()"><i class="fas fa-sync-alt"></i></button>
                                <div class="contacts-body row" id="contactsList" style="width: 100%;">
                                
                                
                                </div>
                                <h2 style="margin: 20px 0 0 0;">Add Contacts</h2>
                                <div id="addformstatus" style="display: block;"></div><h2></h2>
                                <div style="display: block;">
                                    <form onsubmit="return addfriend()" id="friendRequestForm" style="display: block;">
                                        <label for="userename">Username: </label>
                                        <input type="text" id="inputusername" class="form-control" name="inputusername">
                                        <button type="submit" class="btn btn-primary" style="width: 100px;margin:10px 0 0 0;">Add</button>
                                    </form>
                                </div>
    
                            </div>
    
                        </div>
                        <div class="events col-lg-5">
                            <h2 style="display: inline;">Friend Requests</h2><button onclick="return refreshRequests()"><i class="fas fa-sync-alt"></i></button>
                            <div id="friendRequestStatus"></div>
                            <ul class="events-list" id="requests_list">
                            </ul>
                        </div>
                    </div>
                </div>
                    ';
                }
                ?>
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
    <script src="chatscripts.js"></script>

</body>

</html>