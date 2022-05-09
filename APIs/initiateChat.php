<?php
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bossbuddy', 'bindhu', 'bindhu');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt=$pdo->query("select  * from  friends where sl='".$_POST['sl']."'");
$result=$stmt->fetch(PDO::FETCH_ASSOC);
$_SESSION['sender']=$_SESSION['logged'];
if($result['user1']==$_SESSION['sender']){
    $_SESSION['receiver']=$result['user2'];
}
else{
    $_SESSION['receiver']=$result['user1'];
}
?>