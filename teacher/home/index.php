<?php
    include "include/navigationheader.php"; 
    include "time.php"; 
    $fcdpmnt = mysqli_query($conn,"SELECT * FROM department WHERE dp_description='".$row['department']."'");
    $rowdpment=mysqli_fetch_assoc($fcdpmnt);
    $ttsubject=mysqli_query($conn,"SELECT * FROM class WHERE teachid='$newid'");
    $rowttsub=mysqli_num_rows($ttsubject);
 ?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
      <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h1><img src="../../img/facultyhome.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"> <b>Home</b> 
                      <ol class="breadcrumb float-sm-right" style="font-size:15px;">
                          <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                      </ol>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card p-0 pt-2">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                  <a href="my_subject.php">
                  <div class="info-box" id="card-header1">
                    <span class="info-box-icon bg-info elevation-3"><i class="fas fa-book-open"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Total Subject</span>
                      <span class="info-box-number"><?php echo $rowttsub;?></span>
                    </div>
                  </div>
                  </a>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                  <a href="my_student.php">
                  <div class="info-box" id="card-header1">
                    <span class="info-box-icon bg-danger elevation-3"><i class="fas fa-user-graduate"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Total Student</span>
                      <span class="info-box-number"><?php
                      $total = 0;
                        while($rowsublst=mysqli_fetch_assoc($ttsubject)){
                        $studsub = mysqli_query($conn,"SELECT * FROM student_subjects WHERE subid='".$rowsublst['subid']."'");
                        $rowstudsub=mysqli_num_rows($studsub);
                        $total += $rowstudsub;
                      }
                      echo $total;
                      ?></span>
                    </div>
                  </div>
                  </a>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                  <div class="info-box" id="card-header1">
                    <span class="info-box-icon bg-success elevation-3"><img src="<?php echo $row1['ava_location']?>" alt="Logo" class="brand-image img-circle elevation-3" style="width: 50px;"></span>
                    <div class="info-box-content">
                      <span class="info-box-text"><?php echo $_SESSION['name']; ?></span>
                      <span class="info-box-text"><?php echo $_SESSION['username']; ?></span>
                      <span class="info-box-number"></span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                  <div class="info-box" id="card-header1">
                    <span class="info-box-icon bg-warning elevation-3"><img src="<?php echo $rowdpment['logo_path']?>" alt="Logo" class="brand-image img-circle elevation-3" style="width: 50px;"></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Department</span>
                      <span class="info-box-text"><?php echo $row['department']?></span>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-header" id="card-header1">
                      <h3 class="card-title">My Schedule Schedule</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body p-0">
                      <div class="table-responsive ">
                        <table class="table">
                          <thead>
                          <tr>
                            <th>Subject</th>
                            <th>Course</th>
                            <th>Schedule</th>
                            <th>Time</th>
                          </tr>
                          </thead>
                          <tbody>
                              <?php
                              $count = 1;
                              $teach_classload = mysqli_query($conn, "SELECT * FROM class WHERE teachid = '$newid'");
                              $nos = true;
                              while($row1 = mysqli_fetch_array($teach_classload)){
                                  $subject = mysqli_query($conn,"SELECT * FROM student_subjects WHERE subid='".$row1['subid']."'");
                                  $rowcount=mysqli_num_rows($subject);
                                  $subjectinfo = mysqli_query($conn,"SELECT * FROM subject WHERE id='".$row1['subid']."'");
                                  $rowinfo=mysqli_fetch_assoc($subjectinfo);
                                  $nos = false;
                              ?>
                                  <tr>
                                      <td><?php echo $rowinfo['code'];?></td>
                                      <td><?php echo $rowinfo['course'].'-'.$rowinfo['year'];?></td>
                                      <td><?php echo $row1['schedule'];?></td>
                                      <td><?php echo $row1['time'];?></td>
                                  </tr>
                              <?php
                              }if($nos){
                                echo '<td colspan="3" class="text-center">Empty Subject Schedule</td>';
                              }
                              ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="card-footer">
                      <button onclick="location.href='my_subject.php'" class="btn btn-sm btn-dark float-right elevation-3" id="card-header">View All Subject Info.</button>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-header" id="card-header1">
                      <h3 class="card-title">Activity Logs for this Month of <?php echo date('F');?></h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body p-0">
                      <div class="table-responsive ">
                        <table class="table">
                          <thead>
                          <tr>
                            <th>Activity Logs</th>
                            <th>Date</th>
                            <th>Status</th>
                          </tr>
                          </thead>
                          <?php
                          $logs=mysqli_query($conn,"SELECT * FROM log WHERE userid='$id' ORDER BY id DESC LIMIT 8");
                          $checkhome=true;
                          while($rowlogs = mysqli_fetch_assoc($logs)){
                            $checkhome=false;
                                  date_default_timezone_set("Asia/Manila");
                                  $time=strtotime($rowlogs['date']);
                                  $month = date("F",$time);

                            if($month == date('F')){
                          ?>
                            <tbody>
                              <td><?php echo $rowlogs['activity'];?></td>
                              <td><?php echo $rowlogs['date'];?></td>
                              <td><span class='badge badge-warning'><?php echo Time_Convert($rowlogs['date']);?></span></td>
                            </tbody>
                          <?php
                            }
                          }if($checkhome){
                            echo "<td colspan='3' class='text-center'>Empty Activity Logs</td>";
                          }
                          ?>
                        </table>
                      </div>
                    </div>
                    <div class="card-footer">
                      <button onclick="location.href='logs.php'" class="btn btn-sm btn-dark float-right elevation-3" id="card-header">View All Logs</button>
                    </div>
                  </div>
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

