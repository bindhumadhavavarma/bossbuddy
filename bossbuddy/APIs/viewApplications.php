<?php
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bossbuddy', 'bindhu', 'bindhu');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt=$pdo->query("select * from applications where internshipSl='".$_POST['sl']."'");
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    if($row['status']=="Pending"){
        echo '
        <div id="viewApplicationListTile" class="col-md-6" >
                                <h3 style="color: white;">'.$row['username'].'</h3>
                                <a href="'.$row['resume'].'" class="btn btn-secondary" download>Download Resume</a>
                                <button class="btn btn-secondary" onclick="return recruit('.$row['sl'].')">Recruit</button>
                            </div>
        ';
    }
    else{
        echo '
        <div id="viewApplicationListTile" class="col-md-6"  style="background-color:var(--success);>
                                <h3 style="color: white;">'.$row['username'].'</h3>
                                <a href="'.$row['resume'].'" class="btn btn-secondary" download>Download Resume</a>
                                <button class="btn btn-secondary" onclick="return recruit('.$row['sl'].')">Recruit</button>
                            </div>
        ';
    }
}
