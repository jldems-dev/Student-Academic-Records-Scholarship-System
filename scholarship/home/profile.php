<?php
    include "include/navigationheader.php"; 
?>
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h1><i class="fas fa-id-badge"></i> Account Profile
                        <ol class="breadcrumb float-sm-right" style="font-size:18px;">
                            <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item active">Account Profile</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-address-card"></i> Profile Information
                        </div>
                        <div class="card-body">
                            <div class="container-fluid text-center pt-2">
                                <div class="card px-2 pt-2">
                                    <img src="<?php echo $rowinfo['ava_location']?>" alt="Sample" class="profile-user-img img-fluid img-circle" alt="User profile picture">
                                    <div class="dropdown-divider"></div>
                                    <p>
                                        <b>Name </b><br>
                                        <input type="text" class="text-center" value="<?php echo $rowinfo['fname'];?> <?php echo $rowinfo['mname'];?>. <?php echo $rowinfo['lname'];?>" disabled/> <br/>
                                        <b>Posistion</b><br>
                                        <input type="text" class="text-center" value=" <?php echo $rowinfo['status'];?>" disabled><br/>
                                    </p>
                                </div>
                                <div class="btn-group col-sm-3 py-2 float-center">
                                    <button type="submit" onclick="location.href='settings.php'"class="btn btn-sm btn-dark elevation-3" id="button-all"><i class="fas fa-edit"></i> Edit Account</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div id="changeavatar" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form method="post" action="" enctype='multipart/form-data'>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                <input type="file" class="custom-file-input" name="upload_file" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="col-md-12 pt-3">
                                    <button type="submit" class="btn btn-sm btn-dark" name="upload" style="background-color: #00695C;"><i class="fas fa-upload"></i> UPLOAD</button>
                                    <button type="submit" class="btn btn-danger btn-sm float-right" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>