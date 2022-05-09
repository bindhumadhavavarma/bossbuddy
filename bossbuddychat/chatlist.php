<?php
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bossbuddy', 'bindhu', 'bindhu');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt=$pdo->query("select  * from  messages where sender='".$_SESSION['logged']."' and receiver='".$_SESSION['receiver']."' or receiver='".$_SESSION['logged']."' and sender='".$_SESSION['receiver']."'");
$chats=array();$i=0;
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    if($row['sender']==$_SESSION['logged']){
        $temp=0;
    }
    else{
        $temp=1;
    }
    $chats[$i]=[$row['message'],$temp];
    $i++;
}
echo(json_encode($chats));

?>