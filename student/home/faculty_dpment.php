<?php
    include "include/navigationheader.php";
    $teacherinfo = mysqli_query($conn, "SELECT * FROM teacher");
 ?>
<div class="content-wrapper" style="padding-top: 70px">
  <section class="content p-0">
    <div class="col-lg-12">
      <div class ="card" id="index-color">
        <div class="card-header">
          <div class="d-flex align-items-center">
            <button type="button" onclick="history.go(-1);" class="float-left btn btn-sm"><i class="fas fa-arrow-left" id="arrow-back"></i></button>
            <h3 class="card-title w-100"><img src="img/faculty.png" height="24px" width="24px" id="icon-img-shadow"> Faculty</h3>
          </div>
        </div>
      </div>
      <div class="card" id="index-color">
        <div class="card-header">
          <div class="d-flex align-items-center">
            <h3 class="card-title "><i class="fas fa-building"></i> Faculty Department</h3>
          </div>
        </div>
        <div class="card-body p-0">
          <div class="container-fluid pt-2">
            <div class="row">
              <?php
                  $department = mysqli_query($conn,"SELECT * FROM department");
                  $check=true;
                  while($rowdpment=mysqli_fetch_assoc($department)){
                    $check=false;
              ?>
                <div class="col-md-3">
                  <a href="faculty_info.php?dpment=<?php echo $rowdpment['dp_description']; ?>">
                      <div class="card pt-2 px-2" id="index-color1">
                            <h5 class="text-left"><img src="<?php echo $rowdpment['logo_path'];?>" class="brand-image img-circle elevation-3" width="30px">&emsp;<?php echo $rowdpment['dp_description'];?></h5>
                      </div>
                  </a>
                </div>
              <?php
                  }
              ?>
            </div>
            <?php
            if($check){
              ?>
              <div class='text-center'><p>Empty Department</p></div>
              <?php
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
