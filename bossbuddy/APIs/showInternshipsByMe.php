<?php
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bossbuddy', 'bindhu', 'bindhu');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt=$pdo->query("select * from internships where username='".$_SESSION['logged']."'");
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    echo '
    <div id="postedInternshipDetail" style="margin-top:15px;">
                            <h3 style="text-align: center;">Web Developer</h3>
                            <h5 style="text-align: center;">Sparks Foundation</h5>
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
                            <button class="btn btn-secondary" onclick="return viewApplications('.$row['sl'].')" data-toggle="modal" data-target="#viewApplications">View Applications</button>
                        </div>';
}
