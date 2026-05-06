<?php
    include "include/navigationheader.php";
    include "time.php";
    
    $ttfclty=mysqli_query($conn,"SELECT * FROM teacher");
    $ttstd=mysqli_query($conn,"SELECT * FROM student");
    $ttclass=mysqli_query($conn,"SELECT * FROM class");
    $ttu=mysqli_query($conn,"SELECT * FROM userdata");
    $rowttf = mysqli_num_rows($ttfclty);
    $rowtts = mysqli_num_rows($ttstd);
    $rowclass = mysqli_num_rows($ttclass);
    $rowu = mysqli_num_rows($ttu);
 ?>
 <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
              <div class="card">
                <div class="card-header">
                    <h1><img src="../img/facultyhome.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"> <b>Home</b>
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
                    <a href="Faculty/index.php">
                      <div class="info-box" id="card-header1">
                        <span class="info-box-icon bg-info elevation-3"><i class="fas fa-chalkboard-teacher"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Total Faculty</span>
                          <span class="info-box-number">
                            <?php echo $rowttf;?>
                          </span>
                        </div>
                      </div>
                    </a>
                  </div>
                  <div class="col-12 col-sm-6 col-md-3">
                    <a href="Students/index.php">
                      <div class="info-box" id="card-header1">
                        <span class="info-box-icon bg-danger elevation-3"><i class="fas fa-user-graduate"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Total Student</span>
                          <span class="info-box-number"><?php echo $rowtts;?></span>
                        </div>
                      </div>
                    </a>
                  </div>
                  <div class="col-12 col-sm-6 col-md-3">
                    <a href="Class/index.php">
                      <div class="info-box" id="card-header1">
                        <span class="info-box-icon bg-success elevation-3"><i class="fas fa-book"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Class</span>
                          <span class="info-box-number"><?php echo $rowclass;?></span>
                        </div>
                      </div>
                    </a>
                  </div>
                  <div class="col-12 col-sm-6 col-md-3">
                    <a href="User/index.php">
                      <div class="info-box" id="card-header1">
                        <span class="info-box-icon bg-warning elevation-3"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">User Account</span>
                          <span class="info-box-number"><?php echo $rowu;?></span>
                        </div>
                      </div>
                    </a>
                  </div>
                  <div class="col-lg-6">
                    <div class="card">
                      <div class="card-header" id="card-header1">
                        <h3 class="card-title">Latest Request</h3>
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
                              <th>Request Type</th>
                              <th>Date</th>
                              <th>Status</th>
                            </tr>
                            </thead>
                            <?php
                            $rquest=mysqli_query($conn,"SELECT * FROM request ORDER BY id LIMIT 8");
                            $nolt=true;
                            while($rowr = mysqli_fetch_assoc($rquest)){
                              $nolt=false;
                            ?>
                              <tbody>
                                <td><?php echo $rowr['type'];?></td>
                                <td><?php echo $rowr['date'];?></td>
                                <td><?php if($rowr['status'] == 0){ echo "<span class='badge badge-warning'>New</span>";}else{echo "<span class='badge badge-secondary'>Old</span>";}?></td>
                            
                              </tbody>
                            <?php
                            }if($nolt){
                                echo '<td colspan="3" class="text-center">Empty Latest Request</td>';
                            }
                            ?>
                          </table>
                        </div>
                      </div>
                      <div class="card-footer">
                        <button onclick="location.href='request.php'" class="btn btn-sm btn-dark float-right elevation-3" id="card-header">View All Request</button>
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

