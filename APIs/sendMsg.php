<?php
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bossbuddy', 'bindhu', 'bindhu');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt=$pdo->prepare("insert into messages (sender,receiver,message) values (:sender,:receiver,:message)");
$stmt->execute(
    array(
        ':sender'=>$_SESSION['sender'],
        ':receiver'=>$_SESSION['receiver'],
        ':message'=>$_POST['message']
    )
)
?>