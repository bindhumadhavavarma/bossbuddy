<?php
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bossbuddy', 'bindhu', 'bindhu');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt=$pdo->prepare("insert into projects (username,title,company,skills,duration,stipend) values (:username,:title,:company,:skills,:duration,:stipend)");
$stmt->execute(
    array(
        ':username'=>$_SESSION['logged'],
        ':title'=>$_POST['designation'],
        ':company'=>$_POST['company'],
        ':skills'=>$_POST['skills'],
        ':duration'=>$_POST['duration'],
        ':stipend'=>$_POST['stipend']
    )
    );
    echo'<div class="alert alert-successful alert-dismissible fade show" role="alert">Posted Internship Successfully.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
?>