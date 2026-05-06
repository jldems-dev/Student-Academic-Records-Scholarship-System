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
					  <button type="button" onclick="history.go(-1);" class="float-left btn btn-sm"><i class="fas fa-arrow-left" id="arrow-back"></i></button>
					  <h3 class="card-title w-100"><img src="img/scholarship.png" height="24px" width="24px" id="icon-img-shadow"> Scholarship Program</h3>
					</div>
				</div>
			</div>
          <div class="card" >
            <div class="card-header" id="card-header1">
              <div class="d-flex align-items-center">
                <h3 class="card-title"><i class="fas fa-th-list"></i> List of Scholarship Program</h3>
              </div>
            </div>
            <div class="card-body p-0">
                <div class="container-fluid pt-2">
                    <div class="row">
                        <?php
                            $schprogram = mysqli_query($conn,"SELECT * FROM sch_program ORDER BY title ASC");
                            $check = true;
                            while($rowschprog=mysqli_fetch_assoc($schprogram)){
                            $check = false;
                        ?>
                        <div class="col-md-3">
                            <div class="card collapsed-card">
                                <div class="card-header" id="card-header">
                                <h3 class="card-title"><b><?php echo $rowschprog['title']?></b></h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus" id="arrow-back"></i>
                                    </button>
                                </div>
                                </div>
                                <div class="card-body" id="schprog-text">
                                <label for="from-label">List of Scholarship Under: </label>
                                    <hr>
                                    <?php
                                        $count = 1;
                                         $schname = mysqli_query($conn, "SELECT * FROM sch_name WHERE scholarprogram_id='".$rowschprog['id']."'");
                                         while ($rowschname=mysqli_fetch_assoc($schname)){
                                        ?>
                                    <div>
                                        <a href="sch_nameviewinfo.php?schid=<?php echo $rowschname['id'];?>&schname=<?php echo $rowschname['name'];?>"><?php echo $count++;?>. <?php echo $rowschname['name'];?> <?php echo $rowschname['sy'];?></a>
                                        <hr>
                                    </div>
                                    <?php
                                         }
                                        ?>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                    <?php
                      if($check){
                    ?>
                      <div class='text-center'><p>Empty Scholarship Program</p></div>
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