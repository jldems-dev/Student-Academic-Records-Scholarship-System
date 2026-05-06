<?php
    include "include/navigationheader.php";
    $mysubject = mysqli_query($conn, "SELECT * FROM student WHERE studid = '$id'");
    $rowsubject = mysqli_fetch_array($mysubject);
    $dbid = $rowsubject['id'];
 ?>
<div class="content-wrapper float-center" style="padding-top: 70px">
  <section class="content p-0">
    <div class="col-md-12">
      <div class ="card" id="index-color">
        <div class="card-header">
          <div class="d-flex align-items-center">
            <button type="button" onclick="history.go(-1);" class="float-left btn btn-sm"><i class="fas fa-arrow-left" id="arrow-back"></i></button>
            <h3 class="card-title w-100"><img src="img/report.png" height="24px" width="24px" id="icon-img-shadow"> My Grades</h3>
        </div>
        </div>
      </div>
      <div class="card" id="index-color">
        <div class="card-header">
          <div class="d-flex align-items-center">
            <h3 class="card-title "><i class="fas fa-th-list"></i> Grades Type</h3>
          </div>
        </div>
        <div class="card-body p-0" >
          <div class="container-fluid pt-2">
            <div class="row">
              <div class="col-md-4" >
                <a href="my_firstsem.php">
                <div class="small-box" id="index-color1">
                  <div class="inner">
                    <img src="img/1sem.png" alt="Avatar" id="icon-img-shadow">
                    <hr>
                    <h5>First Semester</h5>
                  </div>
                </div>
                </a>
              </div>
              <div class="col-md-4">
              <a href="my_secsem.php">
                <div class="small-box" id="index-color1">
                  <div class="inner">
                  <img src="img/2sem.png" alt="Avatar" id="icon-img-shadow">
                  <hr>
                  <h5>Second Semester</h5>
                  </div>
                </div>
                </a>
              </div>
              <div class="col-md-4">
              <a href="my_finalgrades.php">
                <div class="small-box" id="index-color1">
                  <div class="inner">
                    <img src="img/finalgrades.png" alt="Avatar" id="icon-img-shadow">
                    <hr>
                    <h5>Final Grades</h5>
                  </div>
                </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

