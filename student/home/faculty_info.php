<?php
    include "include/navigationheader.php";
    $dpmentname=$_GET['dpment'];
    $teacherinfo = mysqli_query($conn, "SELECT * FROM teacher WHERE department='$dpmentname'");
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
            <h3 class="card-title "><i class="fas fa-address-card"></i> Faculty Information</h3>
          </div>
        </div>
        <div class="card-body p-0">
          <div class="container-fluid pt-2">
            <div class="row">
              <?php
              $checkntempty=true;
                while($row = mysqli_fetch_assoc($teacherinfo)){
                  $checkntempty=false;
                  $query = mysqli_query($conn, "SELECT * FROM userdata WHERE username='".$row['teachid']."'");
                  $rowquery=mysqli_fetch_assoc($query);
              ?>
              <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                <div class="card bg-light d-flex flex-fill">
                  <div class="card-body pt-2">
                    <div class="row">
                      <div class="col-7 text-left">
                        <h2 class="lead"><b><?php echo $row['fname']?> <?php echo $row['mname']?>. <?php echo $row['lname']?></b></h2>
                        <p class="text-muted text-sm">
                        <b>Status: </b><?php echo $row['status'];?><br>
                        <b>Gender: </b><?php echo $row['gender'];?><br>
                        <b>Status: </b><?php echo $row['status'];?><br>
                        <b>Consultation Time: </b><?php echo $row['consultation_time'];?>
                      </p>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                          <li class="small"><span class="fa-li"><i class="fas fa-envelope"></i></span>Email:&nbsp;<?php echo $row['email']?></li>
                          <li class="small"><span class="fa-li"><i class="fas fa-building"></i></span> Department:&nbsp;<?php echo $row['department']?></li>
                        </ul>
                      </div>
                      <div class="col-5 text-center">
                          <img src="../../teacher/home/<?php echo $rowquery['ava_location'];?>"  alt="<?php echo $row['lname'];?>" class="view_images profile-user-img img-fluid img-circle" id="myImg">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php
                }
              ?>
            </div>
            <?php
               if($checkntempty){
              ?>
                <div class="text-center">
                  <p>Empty Faculty</p>
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
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content" id="m-color">
      <div class="modal-body p-0 text-center" id="file_list">
      <div class="py-2 px-2">
          <span aria-hidden="true" class="close">&times;</span>
      </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).on('click', '.view_images', function(){

    var src = $(this).attr("src");
    var action = "view_profileimg";

    $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action, src:src},
        success:function(data)
        {
            $('#file_list').html(data);
            $('#myModal').modal('show');
        }
        });
  });
</script>
