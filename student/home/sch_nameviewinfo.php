<?php
    include "include/navigationheader.php";

    $schid=$_GET['schid'];
    $schname=$_GET['schname'];

    $schinfo=mysqli_query($conn,"SELECT * FROM sch_name WHERE id='$schid'");
    $rowschinfo=mysqli_fetch_assoc($schinfo);
?>
<div class="content-wrapper" style="padding-top: 70px">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
			<div class ="card" id="index-color">
				 <div class="card-header">
					<div class="d-flex align-items-center">
					  <button type="button" onclick="history.go(-1);" class="float-left btn btn-sm"><i class="fas fa-arrow-left" id="arrow-back"></i></button>
					  <h3 class="card-title w-100"><?php echo $schname;?></h3>
					</div>
				</div>
			</div>
          <div class="card">
            <div class="card-header" id="card-header1">
              <div class="d-flex align-items-center">
                <h3 class="card-title"><?php echo $schname;?> Information</h3>
              </div>
            </div>
            <div class="card-body p-2">
                <div class="row" style="outline: none;">
                    <div class="col-md-6 pt-3">
                        <label class="form-label">Link Full Information</label>
                        <div>
                        <a href="<?php echo $rowschinfo['link'];?>"><i class="fas fa-link"></i> <?php echo $rowschinfo['link'];?></a>
                        </div>
                    </div>
                    <div class="col-md-6 pt-3">
                            <label class="form-label">School Year</label>
                            <input class="form-control" style="background: none; border: none;" value="<?php echo $rowschinfo['sy'];?>" disabled>
                        </div>
                    <div class="col-md-6 pt-3">
                        <label for="form-label">Requirements</label>
                        <textarea class="form-control" rows="10" style="background: none; border: none;" disabled><?php echo $rowschinfo['requirements'];?></textarea>
                    </div>
                    <div class="col-md-6 pt-3">
                        <label for="form-label">Qualification</label>
                        <textarea class="form-control" rows="10" style="background: none; border: none;" disabled><?php echo $rowschinfo['qualification'];?></textarea>
                    </div>
                    <div class="col-md-12 pt-3">
                      <div class="btn-group">
                      <?php
                        if($rowschinfo['status'] == 'Unavailable'){
                          $disabled = 'disabled';
                      ?>
                      <button class="btn btn-sm elevation-3" onclick="location.href='sch_applyform.php?schid=<?php echo $schid;?>&schname=<?php echo $schname;?>&schsy=<?php echo $rowschinfo['sy']?>'" id="card-header" <?php echo $disabled;?>><i class="click fas fa-exclamation-circle" id="schoffice-color"></i> Application Form</button>
                      <?php
                      }else if($rowschinfo['status'] == 'Available'){
                      ?>
                      <button class="btn btn-sm elevation-3" onclick="location.href='sch_applyform.php?schid=<?php echo $schid;?>&schname=<?php echo $schname;?>&schsy=<?php echo $rowschinfo['sy']?>'" id="card-header"><i class="fas fa-check-circle"></i> Application Form</button>
                      <?php
                       }
                      ?>
                      <button class="btn btn-sm elevation-3" id="card-header" onclick="location.href='sch_qualified.php?schid=<?php echo $schid;?>&schname=<?php echo $schname;?>&schsy=<?php echo $rowschinfo['sy']?>'"><i class="fas fa-th-list"></i> Qualified Student</button>
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
<script>
   $('#schoffice-color').click(function(){
      toastr.info('No Submission Of Application Form');
    });
</script>
