<?php
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bossbuddy', 'bindhu', 'bindhu');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt=$pdo->query("select  * from  friends where user1='".$_SESSION['logged']."' and status='1'");
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    echo '
    <div class="row col-md-6" style="margin-bottom: 15px;padding:0 30px 0 30px;">
    <div class="contact row" style="margin: 0;width:100%;">
        <div>'.$row['user2'].'</div>
        <div class="row" style="margin:0 0 0 auto;">
        <div class="deletecontact"><button onclick="initiateChat('.$row['sl'].')"><i class="far fa-comment"></i></button></div>
        <div class="deletecontact"><button onclick="deleteContact('.$row['sl'].')"><i class="far fa-trash-alt"></i></button></div>
        </div>
    </div>
    </div>

    ';
}
$stmt=$pdo->query("select  * from  friends where user2='".$_SESSION['logged']."' and status='1'");
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    echo '
    <div class="row col-md-6" style="margin-bottom: 15px;padding:0 30px 0 30px;">
    <div class="contact row" style="margin: 0;width:100%;">
        <div>'.$row['user1'].'</div>
        <div class="row" style="margin:0 0 0 auto;">
        <div class="deletecontact"><button onclick="initiateChat('.$row['sl'].')"><i class="far fa-comment"></i></button></div>
        <div class="deletecontact"><button onclick="deleteContact('.$row['sl'].')"><i class="far fa-trash-alt"></i></button></div>
        </div>
    </div>
    </div>

    ';
}


?>