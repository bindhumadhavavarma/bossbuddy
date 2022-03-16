<?php
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bossbuddy', 'bindhu', 'bindhu');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$date=$_POST['year']."-".$_POST['month']."-".$_POST['date'];
$stmt=$pdo->query("delete from agenda where sl='".$_POST['sl']."'");
?>