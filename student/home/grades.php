<?php
include "include/navigationheader.php";
$recordid = $_GET['recordid'];
$year = $_GET['year'];
$sem = $_GET['sem'];
$studyear = $_GET['studyear'];
?>
<div class="content-wrapper" style="padding-top: 70px">
    <section class="content p-0">
        <div class="col-lg-12">
            <div class ="card" id="index-color1">
                <div class="card-header">
                <div class="d-flex align-items-center">
                    <button type="button" onclick="history.go(-1);" class="float-left btn btn-sm"><i class="fas fa-arrow-left" id="arrow-back"></i></button>
                    <h3 class="card-title w-100"><img src="img/finalgrades.png" height="24px" witdh="24px"> Final Grades</h3>
                </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="card-header">
                    <div class="d-flex align-items-center">
                    </div>
                </div>
                <div style="background-image: url('img/notvalid.png'); background-position: center; background-repeat:no-repeat;">
                    <div class="card-body p-0">
                        <div class="container-fluid pt-2" >
                            <div class="row">
                                <div class="col-lg-12 text-center" style="font-size: 13px;" >
                                    <p >
                                    <img src="../../img/LogoCSAV.png" alt="Avatar" width="50px" height="50px">
                                    <b><h6>Colegio de Stat.Ana de Victorias INC.</h6></b>
                                    <h6>Osmeña Ave. Brgy 6, Victorias City</h6>
                                    <b>OFFICE OF THE REGISTRAR</b><br/>
                                    <b>STUDENTS SEMESTRAL GRADING REPORT SHEET</b><br/>
                                    <b>FINAL GRADES</b><br/>
                                    <b> <?php echo $sem; ?> SEMESTER, <?php echo $year;?></b>
                                    </p>
                                </div>
                                <div class="table-responsive p-1">
                                    <table class="table table-striped table-bordered table-sm" style="font-size: 13px;">
                                        <thead>
                                            <th>Stud. No.</th>
                                            <th>Name</th>
                                            <th>Sex</th>
                                            <th>Course</th>
                                            <th>Year</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <td><?php echo $row['studid'];?></td>
                                            <td><?php echo $row['lname'];?>, <?php echo $row['fname'];?> <?php echo $row['mname'];?>.</td>
                                            <td><?php echo $row['gender'];?></td>
                                            <td><?php echo $row['course'];?></td>
                                            <td><?php echo $studyear;?><?php echo $row['section'];?></td>
                                            </tr>
                                        </tbody>
                                        <table class="table table-striped table-bordered table-sm" style="font-size: 13px;">
                                            <thead>
                                            <th>Subject</th>
                                            <th>Grades</th>
                                            <th>Units</th>
                                            <th>Remarks</th>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $total=0;
                                                $totaunits = 0;
                                                $recordgrades =mysqli_query($conn,"SELECT * FROM student_subjects WHERE studid='".$row['id']."' AND stud_recordid='$recordid'");
                                                while($rowrecordg=mysqli_fetch_assoc($recordgrades)){
                                                    $subject = mysqli_query($conn,"SELECT * FROM subject WHERE id='".$rowrecordg['subid']."'");
                                                    while ($rowsub = mysqli_fetch_assoc($subject)){

                                                    $prelim = mysqli_query($conn, "SELECT * FROM student_prelim WHERE studid = '".$row['id']."' AND subid='".$rowrecordg['id']."'");
                                                    $rowpre = mysqli_fetch_assoc($prelim);
                                                    $midterm = mysqli_query($conn, "SELECT * FROM student_midterm WHERE studid = '".$row['id']."' AND subid='".$rowrecordg['id']."'");
                                                    $rowmid = mysqli_fetch_assoc($midterm);
                                                    $prefinal = mysqli_query($conn, "SELECT * FROM student_prefinal WHERE studid = '".$row['id']."' AND subid='".$rowrecordg['id']."'");
                                                    $rowpfinal = mysqli_fetch_assoc($prefinal);
                                                    $final = mysqli_query($conn, "SELECT * FROM student_final WHERE studid = '".$row['id']."' AND subid='".$rowrecordg['id']."'");
                                                    $rowfinal = mysqli_fetch_assoc($final);
                                            ?>
                                                <tr>
                                                <td><?php echo $rowsub['code'];?></td>
                                                <td>
                                                <?php
                                                    $average = $rowpre['average'] + $rowmid['average'] + $rowpfinal['average'] + $rowfinal['average'];
                                                    $average = $average /4;
                                                    $average = round($average);
                                                    
                                                    include "gradesheet.php";
                                                ?>
                                                </td>
                                                <td><?php echo $rowsub['unit'];?></td>
                                                <td><?php if ($average > 74.5){ echo  'Passed'; }else if($average == 0){  echo  'None'; }else if($average < 74.5){echo 'Failed';} ?></td>
                                            </tr>
                                            <?php
                                                $totalsub = mysqli_num_rows($recordgrades);
                                                $total += $average;
                                                $average = $total ;
                                                $totaunits += $rowsub['unit'];
                                                    }
                                                }
                                                $total /= $totalsub;
                                            ?>
                                            <tr style="background: yellow;">
                                                <td>General Average: </td>
                                                <td>
                                                <?php  
                                                    $average = round($total);
                                                    echo $average; echo " "; echo "("; include "gradesheet.php"; echo ")"; 
                                                ?>
                                                </td>
                                                <td ><?php echo $totaunits; ?></td>
                                                <td><?php if ($average > 74.5){ echo  'Passed'; }else if($average == 0){  echo  'None'; }else if($average < 74.5){echo 'Failed';} ?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>
</div>