<?php
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bossbuddy', 'bindhu', 'bindhu');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['upload'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["resume"]["name"]);
    $uploadOk = 1;
    $FileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if ($_FILES["resume"]["size"] > 50000000) {
        $_SESSION['error'] = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    else if ($FileType != "pdf") {
        $_SESSION['error'] = "Sorry, only Pdf files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    else {
        if (move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file)) {
            $_SESSION['success'] = "Applied Successfully";
            $stmt = $pdo->prepare("insert into projapplications (username,resume,internshipSl) values(:username,:resume,:internshipSl)");
            $stmt->execute(
                array(
                    ':username' => $_SESSION['logged'],
                    ':resume' => $target_file,
                    ':internshipSl' => $_POST['sl']
                )
            );
        } else {
            $_SESSION['error'] = "Sorry, there was an error uploading your file.";
        }
    }
    header('Location:index.php');
    return;
}

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
    <link rel="stylesheet" href="intStyles.css">
</head>

<body style="background-color: white;">
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
                <li class="nav-item ">
                    <a id="navlink" class="nav-link" href="../workstation/">WorkStation</a>
                </li>
                <li class="nav-item " >
                    <a id="navlink" class="nav-link" href="../internships/">Internships</a>
                </li>
                <li class="nav-item active" id="active">
                    <a id="navlink" class="nav-link" href="#">Freelancing</a>
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

    <div id="maincontainer" style="width: 100%;">
        <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $_SESSION['error'] . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="width:fit-content;margin:0 0 -70px auto;">' . $_SESSION['success'] . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
            unset($_SESSION['success']);
        }

        
        if(!isset($_SESSION['logged'])){
            echo '<h1 style="text-align:center;">Please login to get access to all features</h1>';
        }
        else{
            echo '
            <div id="header" class="row">
            <div id="searchBar">
                <h3><i class="fas fa-search" style="color: var(--secondary);"></i>
                    <input name="search" id="search" type="text" placeholder="Search for Projects" autocomplete="off">
                </h3>
            </div>
            <div id="headerbtn">
                <button data-toggle="modal" data-target="#applicationModal" class="btn btn-primary">
                    <h5>My Applications</h3>
                </button>
                <button class="btn btn-primary"><h5><a href="#postInternshipanchor" style="text-decoration: none;color:white;">Post Projects</a></h5></button>
            </div>
        </div>
        <div id="internshipsList" class="row">
        </div>
        <div id="postInternshipanchor" style="height:150px;margin-top:-150px;visibility:hidden;display:block;"></div>
        <div id="postInternship" >
            <h2>Post a Project.</h2>
            <div id="inner" class="row">
                <div id="postInternshipForm" class="col-md-6">
                    <div id="inner" style="margin: 20px;">
                        <form name="postInternshipForm" onsubmit="return postInternship()">
                            <div id="postStatus"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="designation">Designation : </label>
                                    <input type="text" id="pDesignation" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="company">Company :</label>
                                    <input type="text" id="pCompany" class="form-control" required>
                                </div>
                            </div>

                            <label for="skills">Required Skills :</label>
                            <input type="text" id="pSkills" class="form-control" required>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="duration">Duration :</label>
                                    <input type="number" id="pDuration" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="stipend">Stipend :</label>
                                    <input type="number" id="pStipend" class="form-control" required>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit" style="margin-top: 10px;">Post</button>
                        </form>
                    </div>
                </div>
                <div id="postedInternships" class="col-md-6">
                    <div id="inner" style="margin: 20px;">
                        <h3>Internships posted by you</h3>
                        <div id="postedInternshipsContainer">

                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
            ';
        }
        


        ?>
       

        <
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
        <div class="modal-dialog  modal-dialog-centered">
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
    <!-- My applications modal -->
    <div class="modal fade" id="applicationModal" tabindex="-1" aria-labelledby="applicationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body modalbody">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3>My Applications</h3>
                    <div id="applicationList">

                    </div>

                </div>

            </div>
        </div>
    </div>
    <!--apply Modal -->
    <div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body modalbody">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3>Application</h3>
                    <div id="message1"></div>
                    <form method="POST" action="index.php" enctype="multipart/form-data">
                        <div id="msg"></div>
                        <label for="sl">Code: </label>
                        <input type="number" id="sl" name="sl" class="form-control">
                        <label for="upload">Upload your Resume</label>
                        <input class="form-control" type="file" name="resume" id="resume" accept="application/pdf">
                        <button type="submit" class="btn btn-primary" id="upload" name="upload" style="margin-top: 5px;">Apply</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="viewApplications" tabindex="-1" aria-labelledby="viewApplicationsLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body modalbody">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3>All Applications</h3>
                    <div id="viewApplicationsList" class="row">
                        
                    </div>

                </div>

            </div>
        </div>
    </div>
    <script src="../js/jquery-1.11.3.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="internScripts.js"></script>

</body>

</html>