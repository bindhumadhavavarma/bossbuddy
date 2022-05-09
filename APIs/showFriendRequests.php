<?php
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bossbuddy', 'bindhu', 'bindhu');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$status=0;
$stmt=$pdo->query("select  * from  friends where user2='".$_SESSION['logged']."' and status='".$status."'");
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    echo '
    <li>
    <div class="container-fluid row">
    <div class="event">'.$row['user1'].'</div>
    <div class="delete"><button onclick="acceptRequest('.$row['sl'].')"><i class="fas fa-check"></i></button></div>
    <div class="delete" style="margin-left:15px;"><button onclick="rejectRequest('.$row['sl'].')"><i class="fas fa-times"></i></i></button></div>
    </div>
    </li>

    ';
}



?>