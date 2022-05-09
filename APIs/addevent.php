<?php
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bossbuddy', 'bindhu', 'bindhu');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt=$pdo->prepare("insert into agenda (username,date,time,description) values (:username,:date,:time,:description)");
$stmt->execute(
    array(
        ':username'=>$_SESSION['logged'],
        ':date'=>$_POST['date'],
        ':time'=>$_POST['inputtime'],
        ':description'=>$_POST['inputdesc']
    )
    );
?>