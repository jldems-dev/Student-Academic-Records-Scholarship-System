<?php
    include "include/navigationheader.php";
    $mysubject = mysqli_query($conn, "SELECT * FROM student WHERE studid = '$id'");
    $rowsubject = mysqli_fetch_array($mysubject);
    $dbid = $rowsubject['id'];
 ?>
<div class="content-wrapper" style="padding-top: 70px">
  <section class="content p-0">
    <div class="col-lg-12">
      <div class ="card" id="index-color">
        <div class="card-header">
          <div class="d-flex align-items-center">
            <button type="button" onclick="history.go(-1);" class="float-left btn btn-sm"><i class="fas fa-arrow-left" id="arrow-back"></i></button>
            <h3 class="card-title w-100"><img src="img/scholarshiphome.png" height="24px" width="24px" id="icon-img-shadow"> Scholarship</h3>
          </div>
        </div>
      </div>
      <div class="card" id="index-color">
        <div class="card-header">
          <div class="d-flex align-items-center">
            <h3 class="card-title "><i class="fas fa-th-list"></i> Scholarship Type</h3>
          </div>
        </div>
        <div class="card-body p-0">
          <div class="container-fluid pt-2">
            <div class="row">
              <div class="col-md-3">
                <a href="my_scholarprog.php">
                <div class="small-box" id="index-color1">
                  <div class="inner">
                    <img src="img/scholarship.png" alt="Avatar" id="icon-img-shadow">
                    <hr>
                    <h6>Scholarship Program</h6>
                  </div>
                </div>
                </a>
              </div>
              <div class="col-md-3">
                <a href="my_ancmt.php">
                  <div class="small-box" id="index-color1">
                    <div class="inner">
                      <img src="img/megaphone.png" alt="Avatar" id="icon-img-shadow">
                      <hr>
                      <h6>Scholarship Announcement </h6>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col-md-3" >
                <a href="my_sent.php">
                  <div class="small-box" id="index-color1">
                    <div class="inner">
                      <img src="img/send.png" alt="Avatar" id="icon-img-shadow">
                      <hr>
                      <h6>Send Files</h6>
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

