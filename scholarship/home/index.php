<?php
    include "include/navigationheader.php";
    include "time.php";
    $ttschp = mysqli_query($conn,"SELECT * FROM sch_program");
    $ttancmt = mysqli_query($conn,"SELECT * FROM sch_ancmt");
    $ttschname = mysqli_query($conn,"SELECT * FROM sch_name");
    $ttstd = mysqli_query($conn,"SELECT * FROM student");
    $rowschp=mysqli_num_rows($ttschp);
    $rowancmt=mysqli_num_rows($ttancmt);
    $rowschname=mysqli_num_rows($ttschname);
    $rowstd=mysqli_num_rows($ttstd);
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
                  <li class="breadcrumb-item"><a href="index.php"><i class="fa-solid fa-house-user"></i> Home</a></li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card p-0 py-2">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                  <a href="scholarinfo.php">
                  <div class="info-box" id="card-header1">
                    <span class="info-box-icon bg-info elevation-3"><i class="fas fa-book-reader"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Total Scholarship Program</span>
                      <span class="info-box-number"><?php echo $rowschp;?></span>
                    </div>
                  </div>
                  </a>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                  <a href="announcement.php">
                  <div class="info-box" id="card-header1">
                    <span class="info-box-icon bg-danger elevation-3"><i class="fas fa-bullhorn"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Total Announcement</span>
                      <span class="info-box-number"><?php echo $rowancmt;?></span>
                    </div>
                  </div>
                  </a>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                  <a href="scholarinfo.php">
                  <div class="info-box" id="card-header1">
                    <span class="info-box-icon bg-success elevation-3"><i class="fas fa-book"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Total Scholarship</span>
                      <span class="info-box-number"><?php echo $rowschname;?></span>
                    </div>
                  </div>
                  </a>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                  <a href="documentfiles.php">
                  <div class="info-box" id="card-header1">
                    <span class="info-box-icon bg-warning elevation-3"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Total Students</span>
                      <span class="info-box-number"><?php echo $rowstd;?></span>
                    </div>
                  </div>
                  </a>
                </div>
                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-header" id="card-header1">
                      <h3 class="card-title">Latest Student Sent Documents</h3>
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
                            <th>Student</th>
                            <th>Date</th>
                            <th>Status</th>
                          </tr>
                          </thead>
                            <tbody>
                            <?php
                            $date = date("Y-m-d h:i:s A");
                            $schfiles=mysqli_query($conn,"SELECT * FROM sch_files ORDER BY date LIMIT 8");
                            $nossd=true;
                            while($rowschfiles = mysqli_fetch_assoc($schfiles)){
                              $rowstudi=mysqli_fetch_assoc($ttstd);
                              $nossd=false;

                              if($rowstudi['id'] == $rowschfiles['studid']){
                            ?>
                              <tr>
                                <td><?php echo $rowstudi['fname'];?> <?php echo $rowstudi['mname'];?>. <?php echo $rowstudi['lname'];?></td>
                                <td><?php echo $rowschfiles['date'];?></td>
                                <td><?php echo Time_Convert($rowschfiles['date']);?></td>
                              </tr>
                            <?php
                              }
                            }if($nossd){
                              echo '<td colspan="3" class="text-center">Empty Sent Documents</td>';
                            }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="card-footer">
                      <button onclick="location.href='documentfiles.php'" class="btn btn-sm btn-dark float-right elevation-3" id="card-header">View Sent Files</button>
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
  </section>
</div>

