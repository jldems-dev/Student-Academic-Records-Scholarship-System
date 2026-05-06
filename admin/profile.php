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
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-address-card"></i> Profile Information
                        </div>
                        <div class="card-body p-1">
                            <div class="container-fluid text-center pt-2">
                                <div class="card px-2 pt-2">
                                <img src="<?php echo $row['ava_location']?>" alt="Sample" class="profile-user-img img-fluid img-circle" alt="User profile picture">
                                <div class="dropdown-divider"></div>
                                    <p>
                                        <b>Full Name </b><br/>
                                        <input type="text" class="text-center" value="<?php echo $row['fname'];?> <?php echo $row['mname'];?>. <?php echo $row['lname'];?>" disabled/> <br/>
                                        <b>Posistion</b><br/>
                                        <input type="text" class="text-center" value=" <?php echo $row['status'];?>" disabled><br/>
                                    </p>
                                </div>
                                <div class="btn-group col-sm-3 py-2 float-center">
                                    <button type="submit" onclick="location.href='settings.php'"class="btn btn-sm btn-dark elevation-3" id="button-all"><i class="fas fa-edit"></i> Edit Profile</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>