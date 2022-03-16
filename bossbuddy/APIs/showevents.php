<?php
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bossbuddy', 'bindhu', 'bindhu');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$date=$_POST['year']."-".$_POST['month']."-".$_POST['date'];
$stmt=$pdo->query("select  * from  agenda where username='".$_SESSION['logged']."' and date='".$date."' order by time;");
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    $time=strval($row['time']);
    echo '
    <li>
    <div class="container-fluid row">
    <div class="time">'.$row['time'].'</div>
    <div class="event">'.$row['description'].'</div>
    <div class="delete"><button onclick="deleteevent('.$row['sl'].')"><i class="far fa-trash-alt"></i></button></div>
    </div>
    </li>

    ';
}



?>