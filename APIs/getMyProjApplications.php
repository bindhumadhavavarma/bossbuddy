<?php
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bossbuddy', 'bindhu', 'bindhu');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt=$pdo->query("select * from projapplications where username='".$_SESSION['logged']."'");
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    $stmt2=$pdo->query("select * from projects where sl='".$row['internshipSl']."'");
    $row2=$stmt2->fetch(PDO::FETCH_ASSOC);
    echo
    '
                        <div id="internshipModal" style="margin-bottom:15px";>
                            <h3 style="text-align: center;color:white;">'.$row2['title'].'</h3>
                            <h5 style="text-align: center;color:white">'.$row2['company'].'</h5>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <b>Required Skills</b>
                                </div>
                                <div class="col-sm-8">
                                    : '.$row2['skills'].'
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <b>Duration</b>
                                </div>
                                <div class="col-sm-8">
                                    : '.$row2['duration'].'
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <b>Stipend</b>
                                </div>
                                <div class="col-sm-8">
                                    : '.$row2['stipend'].'
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <b>Application Status</b>
                                </div>
                                <div class="col-sm-8">
                                    : '.$row['status'].'
                                </div>
                            </div>
                        </div>
    ';
}
?>