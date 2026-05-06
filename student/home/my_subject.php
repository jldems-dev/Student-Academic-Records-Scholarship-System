<?php
    include "include/navigationheader.php";

    $mysubject = mysqli_query($conn, "SELECT * FROM student WHERE studid = '$id'");
    $rowsubject = mysqli_fetch_array($mysubject);

    $year = date("Y")-1;
    $year1 = date("Y");
    $yearall =  $year.'-'.$year1;

    $dbid = $rowsubject['id'];
 ?>
<div class="content-wrapper" style="padding-top: 70px">
  <section class="content p-0">
      <div class="col-lg-12">
        <div class ="card" id="index-color">
          <div class="card-header">
            <div class="d-flex align-items-center">
              <button type="button" onclick="history.go(-1);" class="float-left btn btn-sm"><i class="fas fa-arrow-left" id="arrow-back"></i></button>
              <h3 class="card-title w-100"><img src="img/learning.png" height="24px" width="24px" id="icon-img-shadow"> My Subject</h3>
          </div>
         </div>
        </div>
        <div class="card">
          <div class="card-header" id="card-header1">
            <div class="d-flex align-items-center">
              <h3 class="card-title"><i class="fas fa-th-list"></i> List of Subjects</h3>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="container-fluid pt-2">
              <div class="row">
                <?php
                $f = 0;
                $s = 0;
                  $check=true;

                  $studentrecord=mysqli_query($conn,"SELECT * FROM student_record WHERE studid='$dbid' AND sy='$yearall'");
                  
                  while($rowstudrec=mysqli_fetch_assoc($studentrecord)){

                      $studentsubjects = mysqli_query($conn,"SELECT * FROM student_subjects WHERE studid='$dbid' AND stud_recordid='".$rowstudrec['id']."'");
                      while($rowsubject1 = mysqli_fetch_assoc($studentsubjects)){

                        $subject = mysqli_query($conn,"SELECT * FROM subject WHERE id='".$rowsubject1['subid']."'");
                        while($rowsub=mysqli_fetch_assoc($subject)){
                          
                          $class1 = mysqli_query($conn,"SELECT * FROM class WHERE sub_code='".$rowsub['code']."' AND subid='".$rowsub['id']."'");
                          $classrow = mysqli_fetch_array($class1);
                          
                          $myteacher = mysqli_query($conn,"SELECT * FROM teacher WHERE id='".$classrow['teachid']."'");
                          $row6 = mysqli_fetch_assoc($myteacher);
                          $check=false;
                ?>
                <?php
                    if($rowsubject1['sem'] == '1st'){
                      if(!$f++){
                        echo "<div class='col-12 px-2 py-2'><b>First Semester</b></div>";
                        
                      }
                ?>
                <div class="col-md-3">
                  <div class="card collapsed-card" >
                    <div class="card-header" id="card-header">
                      <h3 class="card-title"><b><?php echo $rowsub['code']?></b></h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-plus" id="arrow-back"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body p-1">
                      <div class="text-left" id="mysubject-text">
                        <p>
                          <b>Teacher Name:</b>  <?php if($row6['fname'] == '' && $row6['fname'] == '' && $row6['fname'] == ''){ echo "Unknown"; } else{ echo $row6['fname']." ".$row6['mname'].". ".$row6['lname'];}?><br>
                          <b>Subjects Title:</b> <?php echo $rowsub['title']?><br/>
                          <b>Semester:</b> <?php echo $rowsub['sem'];?><br/>
                          <b>Course:</b> <?php echo $rowsub['course'];?><br/>
                          <b>Units:</b> <?php echo $rowsub['unit'];?><br/>
                          <b>Schedule:</b> <?php if($classrow['schedule'] == ''){echo "N/A"; }else{echo $classrow['schedule'];}?><br/>
                          <b>Time:</b> <?php if($classrow['time'] == ''){ echo "N/A"; } else{echo $classrow['time'];}?><br/>
                          <b>sy:</b> <?php echo $rowstudrec['sy'];?>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
                        }
                ?>
                <?php
                    if($rowsubject1['sem'] == '2nd'){
                      if(!$s++){
                        echo "<div class='col-12 px-2 py-2'><b>Second Semester</b></div><br>";
                      }
                ?>
                <div class="col-md-3">
                  <div class="card collapsed-card" >
                    <div class="card-header" id="card-header">
                      <h3 class="card-title"><b><?php echo $rowsub['code']?></b></h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-plus" id="arrow-back"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body p-1">
                      <div class="text-left" id="mysubject-text">
                        <p>
                        <b>Teacher Name:</b>  <?php if($row6['fname'] == '' && $row6['fname'] == '' && $row6['fname'] == ''){ echo "Unknown"; } else{ echo $row6['fname']." ".$row6['mname'].". ".$row6['lname'];}?><br>
                          <b>Subjects Title:</b> <?php echo $rowsub['title']?><br/>
                          <b>Semester:</b> <?php echo $rowsub['sem'];?><br/>
                          <b>Course:</b> <?php echo $rowsub['course'];?><br/>
                          <b>Units:</b> <?php echo $rowsub['unit'];?><br/>
                          <b>Schedule:</b> <?php if($classrow['schedule'] == ''){echo "N/A"; }else{echo $classrow['schedule'];}?><br/>
                          <b>Time:</b> <?php if($classrow['time'] == ''){ echo "N/A"; } else{echo $classrow['time'];}?><br/>
                          <b>sy:</b> <?php echo $rowstudrec['sy'];?>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
                        }
                ?>
                <?php
                        }
                      }
                  }
                ?>
                </div>
                <?php
                  if($check){
                    ?>
                    <div class="text-center">
                      <p>Empty Subjects</p>
                    </div>
                  <?php
                  }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>
</div>

