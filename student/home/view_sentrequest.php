<?php
    include "include/navigationheader.php";
    $requestid = $_GET['requestid'];
    $request = mysqli_query($conn,"SELECT * FROM request WHERE id='$requestid'");
    $rowrequest=mysqli_fetch_assoc($request);
?>
<div class="content-wrapper" style="padding-top: 70px">
  <section class="content p-0">
    <div class="col-lg-12">
      <div class ="card" id="index-color">
        <div class="card-header">
          <div class="d-flex align-items-center">
            <button type="button" onclick="history.go(-1);" class="float-left btn btn-sm"><i class="fas fa-arrow-left" id="arrow-back"></i></button>
            <h3 class="card-title w-100"><img src="img/send.png" height="24px" width="24px"> Sent</h3>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="card-header1">
            <div class="d-flex align-items-center">
            <h3 class="card-title w-100"><i class="fas fa-mail-bulk"></i> Sent Files View</h3>
            </div>
        </div>
        <div class="card-body p-0">
          <div class="container-fluid pt-2">
            <div class="row">
              <div class="col-md-4 pt-3">
                  <label for="form-label">Date Sent</label>
                  <input type="text" class="form-control"  value="<?php echo $rowrequest['date'];?>" disabled>
              </div>
              <div class="col-md-4 pt-3">
                  <label for="form-label">Name</label>
                  <input type="text" class="form-control"  value="<?php echo $rowrequest['student_fullname'];?>" disabled>
              </div>
              <div class="col-md-4 pt-3">
                  <label for="form-label">Request Message</label>
                  <?php
                    if($rowrequest['type'] == 'Account'){
                  ?>
                  <textarea cols="57"class="form-control"  disabled><?php echo $rowrequest['student_request'];?></textarea>
                  <?php
                    }else if($rowrequest['type'] == 'Grades'){
                  ?>
                  <input type="text" class="form-control"  value="<?php echo $rowrequest['student_request'];?>" disabled>
                  <input type="text" class="form-control"  value="<?php echo $rowrequest['sy'];?>" disabled>
                  <input type="text" class="form-control"  value="<?php echo $rowrequest['semester'];?>" disabled>
                  <?php
                    }
                  ?>
              </div>
              <div class="col-md-4 py-3">
                  <label for="form-label">To</label>
                  <input type="text"  class="form-control" value="Registrar Office" disabled>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script>
    $('#sent_form').on('submit', function(){
        $.ajax({
        url:"upload.php",
        method:"POST",
        data:new FormData(this),
        contentType: false,
           cache: false,
         processData:false,
        success: function(data)
        {
            alert(data);
        }
        });
    });
</script>