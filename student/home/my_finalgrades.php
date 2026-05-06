<?php
    include "include/navigationheader.php";
?>
<div class="content-wrapper" style="padding-top: 70px">
  <section class="content p-0">
    <div class="col-lg-12">
      <div class ="card" id="index-color">
        <div class="card-header">
          <div class="d-flex align-items-center">
            <button type="button" onclick="history.go(-1);" class="float-left btn btn-sm"><i class="fas fa-arrow-left" id="arrow-back"></i></button>
            <h3 class="card-title w-100"><img src="img/finalgrades.png" height="24px" witdh="24px" id="icon-img-shadow"> Final Grades</h3>
          </div>
        </div>
      </div>
      
      <div class="card" id="index-color">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-th-list"></i> List of Final Grades</h3>
            <button type="button" class="btn btn-sm btn-primary float-right elevation-3" onclick="location.href='my_sent.php'"><i class="fas fa-envelope"></i> Request</button>
        </div>
        <div class="card-body p-0">
          <div class="container-fluid pt-2">
            <div class="row">
              <?php
                  $check = true;
                  $recordgrades =mysqli_query($conn,"SELECT * FROM student_record WHERE studid='".$row['id']."' AND status='release' ORDER BY stud_year ASC");
                  while($rowrecordg=mysqli_fetch_assoc($recordgrades)){
                  $check = false;
              ?>
                <div class="col-md-3" >
                  <a href="grades.php?recordid=<?php echo $rowrecordg['id'];?>&year=<?php echo $rowrecordg['sy'];?>&sem=<?php echo $rowrecordg['sem'];?>&studyear=<?php echo $rowrecordg['stud_year'];?>">
                    <div class="card pt-2 px-2" id="index-color1">
                        <h6><img src="img/viewgrades.png" width="30px">&emsp;<?php if($rowrecordg['stud_year'] == 4){echo "4th Year";}else if($rowrecordg['stud_year']){echo "1st Year";}?> / <?php echo $rowrecordg['sem'];?> Semester / <?php echo $rowrecordg['sy'];?></h6>
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
                  <div class="text-center">
                    <p>Empty Final Grades</p>
                  </div>
                <?php
                }
              ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>