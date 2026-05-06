<?php
    include "include/navigationheader.php";

    $mygrades = mysqli_query($conn, "SELECT * FROM student WHERE studid = '$id'");
    $rowgrades = mysqli_fetch_array($mygrades);
    $year = date("Y")-1;
    $year1 = date("Y");
    $yearall =  $year.'-'.$year1;
    
    $dbid = $rowgrades['id'];

 ?>
<div class="content-wrapper" style="padding-top: 70px">
  <section class="content p-0">
  <div class="col-lg-12">
      <div class ="card" id="index-color">
        <div class="card-header">
          <div class="d-flex align-items-center">
            <button type="button" onclick="history.go(-1);" class="float-left btn btn-sm"><i class="fas fa-arrow-left" id="arrow-back"></i></button>
            <h3 class="card-title w-100"><img src="img/2sem.png" width="24px" height="24px" id="icon-img-shadow"> Second Semester</h3>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="card-header1">
          <h3 class="card-title">School Year: <?php echo date("Y")-1;?>-<?php echo date("Y");?></h3>
        </div>
        <div class="card-body p-0">
          <div class="container-fluid pt-2">
            <div class="row">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm" id="table-fsemester">
                  <thead>
                    <tr>
                      <th>Subject</th>
                      <th>Prelim</th>
                      <th>Midterm</th>
                      <th>Prefinal</th>
                      <th>Final</th>
                      <th>Progress</th>
                      <th style="width: 40px">Label</th>
                    </tr>
                  </thead>
                    <?php
                      $record = mysqli_query($conn,"SELECT * FROM student_record WHERE studid='$dbid' AND sem='2nd'");
                      $recordrow=mysqli_fetch_assoc($record);
                      $check = true;
                      if(mysqli_num_rows($record) > 0){

                      

                        $mysubject = mysqli_query($conn,"SELECT * FROM student_subjects WHERE studid='$dbid' AND sem='".$recordrow['sem']."' AND sy='$yearall'");
                        while($rowsubject = mysqli_fetch_assoc($mysubject)){

                        $subject = mysqli_query($conn,"SELECT * FROM subject WHERE id='".$rowsubject['subid']."'");
                        $rowsub=mysqli_fetch_assoc($subject);
                        $check = false;

                          $prelim = mysqli_query($conn,"SELECT * FROM student_prelim WHERE studid='$dbid' AND subid='".$rowsubject['subid']."'");
                          $row = mysqli_fetch_assoc($prelim);
                          $midterm = mysqli_query($conn,"SELECT * FROM student_midterm WHERE studid='$dbid' AND subid='".$rowsubject['subid']."'");
                          $row1 = mysqli_fetch_assoc($midterm);
                          $prefinal = mysqli_query($conn,"SELECT * FROM student_prefinal WHERE studid='$dbid' AND subid='".$rowsubject['subid']."'");
                          $row2 = mysqli_fetch_assoc($prefinal);
                          $final = mysqli_query($conn,"SELECT * FROM student_final WHERE studid='$dbid' AND subid='".$rowsubject['subid']."'");
                          $row3 = mysqli_fetch_assoc($final);
                      
                        
                    ?>
                  <tbody>
                  <tr>
                      <td ><?php echo $rowsub['code'];?></td>
                      <td><?php echo $row['average'];?></td>
                      <td><?php echo $row1['average'];?></td>
                      <td><?php echo $row2['average'];?></td>
                      <td><?php echo $row3['average'];?></td>
                      <td>
                        <?php 
                        
                        $average = $row['average'] + $row1['average'] + $row2['average'] + $row3['average'];
                        $average = $average / 4;
                        $average = round($average);
                        
                        ?>
                        <div class="progress progress-xs">
                          <div class="progress-bar progress-bar-danger" style="width: <?php echo $average;?>%; background: <?= ($average < 75 ? 'red' : 'blue'); ?>;"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-danger"><?php echo $average;?>%</span></td>
                    </tr>
                  </tbody>
                    <?php
                        }
                      }if($check){
                        echo "<tr>
                        <td colspan='10' class ='text-center'>No Grades Found</td>
                        </tr> 
                        ";
                      }
                    ?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
