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
              <button type="button" onclick="history.back()" class="float-left btn btn-sm"><i class="fas fa-arrow-left" id="arrow-back"></i></button>
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
                        <input type="text" class="form-control" value="<?php echo $row['fname']?> <?php echo $row['mname']?>. <?php echo $row['lname']?>" disabled>
                    </div>
                    <div class="col-md-6 pt-3">
                        <label for="form-label" >To</label>
                        <input type="text" class="form-control" value="Registrar Office" disabled>
                    </div>
                    <div class="col-md-6 pt-3">
                        <label for="form-label">Final Grades Request Type</label>
                        <select name="fgrades" id="fgrades" class="form-control">
                            <option value="" selected disabled>Select</option>
                            <option>Online View Copy of Final Grades</option>
                            <option>True Copy of Final Grades</option>
                        </select>
                    </div>
                    <div class="col-md-6 pt-3">
                        <label class="form-label">Final Grades School Year</label>
                        <select id="sy" name="sy" class="form-control" required>
                        <option value="">Select</option>
                        <?php
                            for( $y = 2020; $y <= 2100; $y++ ) {
                                ?>
                                    <option value="<?php echo $y-1; ?>-<?php echo $y; ?>"><?php echo $y-1; ?>-<?php echo $y; ?></option>
                                <?php
                            }
                        ?>
                        </select>
                    </div>
                    <div class="col-md-6 pt-3">
                        <label for="form-label">Final Grades Semester</label>
                        <select name="sem" id="sem" class="form-control">
                            <option value="" selected disabled>Select</option>
                            <option>1st</option>
                            <option>2nd</option>
                        </select>
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
<script>

$('#sent_form').on('submit', function(){

    var studid = $('#studid').val();
    var fgrades = $('#fgrades').val();
    var sy = $('#sy').val();
    var sem = $('#sem').val();

    var action = "sent_request";

    $.ajax({
    url:"action.php",
    method:"POST",
    data:{action:action,fgrades:fgrades,sy:sy,sem:sem,studid:studid},
    success:function(data)
    {
        toastr.warning(data);
    }
    });
});
</script>