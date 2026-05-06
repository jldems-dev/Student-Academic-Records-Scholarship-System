<?php
    include "include/navigationheader.php";
?>
<div class="content-wrapper" style="padding-top: 70px">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
        <div class ="card" id="index-color">
         <div class="card-header">
            <div class="d-flex align-items-center">
              <button type="button" onclick="location.href='my_sent.php'" class="float-left btn btn-sm"><i class="fas fa-arrow-left" id="arrow-back"></i></button>
              <h3 class="card-title w-100"><img src="img/compose.png" height="24px" width="24px" id="icon-img-shadow"> Compose</h3>
          </div>
         </div>
       </div>
        <?php
          include "alert.php";
          ?>
          <div class="card">
            <div class="card-body p-2">
                <form method="post" id="sent_form" enctype='multipart/form-data' class="row">
                    <div class="col-md-6">
                        <label for="form-label">From</label>
                        <input type="text" class="form-control" name="studname" id="studname" value="<?php echo $row['fname']?> <?php echo $row['mname']?>. <?php echo $row['lname']?>" disabled>
                    </div>
                    <div class="col-md-6 pt-3">
                        <label for="form-label" >To</label>
                        <input type="text" class="form-control" value="Scholarship Office" disabled>
                    </div>
                    <div class="col-md-6 pt-3">
                        <label for="form-label">Scholarship Name</label>
                        <select name="schname" id="schname" class="form-control">
                            <option value="" selected disabled> Select Scholarship</option>
                            <?php
                            $schname=mysqli_query($conn,"SELECT * FROM sch_name");
                            while($rowschname=mysqli_fetch_assoc($schname)){
                            ?>
                            <option value="<?php echo $rowschname['name']?>"><?php echo $rowschname['name']?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6 pt-3 pb-3">
                        <label for="exampleInputFile"><i class="fas fa-file-upload"></i> Attach File</label>
                        <div class="input-group">
                            <div class="custom-file">
                            <input type="file" class="custom-file-input" id="uploadImage" name="files[]" multiple>
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 pt-3 pb-3">
                        <button type="submit" class="btn btn-sm elevation-3" id="index-color1"><i class="fas fa-paper-plane" ></i> Sent</button>
                        <input type="hidden" name="studid" id="studid" value="<?php echo $row['id'];?>"/>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
<script type='text/javascript'>

 $(document).ready(function(){
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
});
</script>