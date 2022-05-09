<?php
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bossbuddy', 'bindhu', 'bindhu');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$status=0;
$stmt=$pdo->query("update friends set status='1' where sl='".$_POST['sl']."'");

    echo '
    <div class="alert alert-success alert-dismissible fade show" role="alert">Friend Request Accepted<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
    ';




?>