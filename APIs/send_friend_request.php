<?php
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bossbuddy', 'bindhu', 'bindhu');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt=$pdo->query("select * from users where username='".$_POST['user2']."'");
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$error=0;
if($row==null){
    $error=1;
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Username does not exist.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
}
$status=0;
$stmt=$pdo->query("select * from friends where user1='".$_SESSION['logged']."' and user2='".$_POST['user2']."' and status='".$status."'");
$row=$stmt->fetch(PDO::FETCH_ASSOC);
if($row!=null){
    $error=1;
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Request already sent.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
}

$stmt=$pdo->query("select * from friends where user2='".$_SESSION['logged']."' and user1='".$_POST['user2']."' and status='".$status."'");
$row=$stmt->fetch(PDO::FETCH_ASSOC);
if($row!=null){
    $error=1;
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.$_POST['user2'].' has already sent you a request.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
}

$stmt=$pdo->query("select * from friends where user1='".$_SESSION['logged']."' and user2='".$_POST['user2']."' and status='1'");
$row=$stmt->fetch(PDO::FETCH_ASSOC);
if($row!=null){
    $error=1;
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Friend already exists.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
}

$stmt=$pdo->query("select * from friends where user2='".$_SESSION['logged']."' and user1='".$_POST['user2']."' and status='1'");
$row=$stmt->fetch(PDO::FETCH_ASSOC);
if($row!=null){
    $error=1;
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Friend already exists.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
}
if($error==0){

    $stmt=$pdo->prepare("insert into friends (user1,user2,status) values(:user1,:user2,:status)");
    $stmt->execute(
        array(
            ':user1'=>$_SESSION['logged'],
            ':user2'=>$_POST['user2'],
            ':status'=>0
        )
        );
        
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Friend Request sent.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
            
}



?>