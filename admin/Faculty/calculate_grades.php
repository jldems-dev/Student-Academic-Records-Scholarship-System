<?php
    include('../include/navigationheader1.php'); 
    $teach_id = $_GET['teachid'];
    $classid = $_GET['classid'];

    $teach_classload = mysqli_query($conn, "SELECT * FROM class WHERE teacher = '$teach_id' AND id='$classid'");
    $row = mysqli_fetch_assoc($teach_classload);
    $studentlist = mysqli_query($conn, "SELECT * FROM student_prelim WHERE classid='$classid'");

    $subject =mysqli_query($conn,"SELECT * FROM subject WHERE id='".$row['subject']."'");
    $rowsub = mysqli_fetch_assoc($subject);
    
    

?>
<div class="content-wrapper pt-4">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><b><?php echo $rowsub['code'];?>-<?php echo $rowsub['title'];?></b></h3>
                        </div>
                        <div class="table-responsive px-2 pt-3">
                            <table class="table table-striped table-bordered table-sm">
                                <thead>
                                    <th>Stud. ID#</th>
                                    <th>Student Name</th>
                                    <th>Prelim</th>
                                    <th>Midterm</th>
                                    <th>Prefinal</th>
                                    <th>Final</th>
                                    <th>Average</th>
                                    <th width="15px">Remarks</th>
                                </thead>
                                <?php
                                    while($row1 = mysqli_fetch_assoc($studentlist)){
                                        $studentid = $row1['studid'];
                                        $studentname = mysqli_query($conn, "SELECT * FROM student WHERE id='$studentid'");
                                        while($row2 = mysqli_fetch_assoc($studentname)){
                                        $prelim = mysqli_query($conn, "SELECT * FROM student_prelim WHERE studid = '$studentid' AND classid='$classid'");
                                        $row3 = mysqli_fetch_assoc($prelim);
                                        $midterm = mysqli_query($conn, "SELECT * FROM student_midterm WHERE studid = '$studentid' AND classid='$classid'");
                                        $row4 = mysqli_fetch_assoc($midterm);
                                        $prefinal = mysqli_query($conn, "SELECT * FROM student_prefinal WHERE studid = '$studentid' AND classid='$classid'");
                                        $row5 = mysqli_fetch_assoc($prefinal);
                                        $final = mysqli_query($conn, "SELECT * FROM student_final WHERE studid = '$studentid' AND classid='$classid'");
                                        $row6 = mysqli_fetch_assoc($final);
                                ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $row2['studid'];?></td>
                                        <td><?php echo $row2['lname']?>, <?php echo $row2['fname'];?> <?php echo $row2['mname']?>.</td>
                                        <td style="background: yellow;"><?php echo $row3['average'];?></td>
                                        <td style="background: yellow;"><?php echo $row4['average'];?></td>
                                        <td style="background: yellow;"><?php echo $row5['average'];?></td>
                                        <td style="background: yellow;"><?php echo $row6['average'];?></td>
                                        <td style="background: green;">
                                        <?php
                                         $average = $row3['average'] + $row4['average'] + $row5['average'] + $row6['average'];
                                         $average = $average /4;
                                         $average = round($average);
                                         echo $average;
                                        ?>
                                        </td>
                                        <td style="background: <?= ($average > 74 ? 'green' : 'red'); ?>" ><?php if ($average > 74.5){ echo  'Pass'; }else if($average == 0){  echo  'None'; }else if($average < 74.5){ echo 'Failed';} ?></td>
                                    </tr>
                                </tbody>
                                <?php
                                        }
                                    }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </section>
</div>