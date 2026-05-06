<?php
    include "include/navigationheader.php";
    $fileid = $_GET['schfile'];
    $schname = $_GET['schname'];
    $date = $_GET['date'];
    $displayfile = mysqli_query($conn,"SELECT * FROM sch_files WHERE studid='$fileid' AND sch_name='$schname' AND date='$date'");
    
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
      <div class="card" >
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
                  <input type="text" class="form-control"  value="<?php echo $date;?>" disabled>
              </div>
              <div class="col-md-4 pt-3">
                  <label for="form-label">Name</label>
                  <input type="text" class="form-control"  value="<?php echo $row['fname']?> <?php echo $row['mname']?>. <?php echo $row['lname']?>" disabled>
              </div>
              <div class="col-md-4 pt-3">
                  <label for="form-label">Scholarship Name</label>
                  <input type="text"  class="form-control" value="<?php echo $schname;?>" disabled>
              </div>
              <div class="col-md-4 pt-3">
                  <label for="form-label">To</label>
                  <input type="text"  class="form-control" value="Scholarship Office" disabled>
              </div>
              <div class="col-md-12 pt-3 pb-3">
                  <label for="exampleInputFile"><i class="far fa-file-alt"></i> File</label>
                  <?php
                    while($rowfile=mysqli_fetch_assoc($displayfile)){
                  ?>
                  <div class="card col-md-3">
                    <a href="<?php echo $rowfile['file_path'];?>"><i class="fas fa-file-alt"></i> <?php echo $rowfile['file_name'];?></a>
                  </div>
                  <?php
                    }
                  ?>
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