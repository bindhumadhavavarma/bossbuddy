<?php
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bossbuddy', 'bindhu', 'bindhu');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$name=$_POST['search'];
$stmt=$pdo->query("select * from internships where designation like '%$name%' or company like '%$name%' or location like '%$name%' or duration like '%$name%' or stipend like '%$name%' or sl like '%$name%'");
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    echo '
    <div id="internshipDetail" class="col-md-4">
    <div id="internshipInner">
    <h3 style="text-align: center;">'.$row['designation'].'</h3>
    <h5 style="text-align: center;color:white">'.$row['company'].'</h5>
    <hr>
    <div class="row">
        <div class="col-sm-4">
            <b>Required Skills</b>
        </div>
        <div class="col-sm-8">
            : '.$row['skills'].'
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <b>Location</b>
        </div>
        <div class="col-sm-8">
            : '.$row['location'].'
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <b>Duration</b>
        </div>
        <div class="col-sm-8">
            : '.$row['duration'].' Months
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <b>Stipend</b>
        </div>
        <div class="col-sm-8">
            : '.$row['stipend'].'
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <b>Code</b>
        </div>
        <div class="col-sm-8">
            : '.$row['sl'].'
        </div>
    </div>
    <div style="margin: 0 5px 0 auto;width:fit-content;"><button data-toggle="modal" data-target="#applyModal"><i class="fas fa-check"></i></button></div>
</div></div>';
}
