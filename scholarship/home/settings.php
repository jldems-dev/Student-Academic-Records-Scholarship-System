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
                        <h1><i class="fas fa-cog"></i> Account Settings
                        <ol class="breadcrumb float-sm-right" style="font-size:18px;">
                            <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item active">Account Settings</li>
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
                            <h4><i class="fas fa-edit"></i>Edit Information
                        </div>
                        <div class="card-body p-1">
                            <div class="row">
                                <div class="col-sm-6 pt-2">
                                    <div class="card">
                                        <div class="card-header" id="card-header">
                                            <h3 class="card-title text-center" data-card-widget="collapse"><b>Change Profile</b></h3>
                                        </div>
                                        <div class="form-group  py-4 px-2">
                                            <label for="exampleInputFile">File input</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="upload_image" id="upload_image" accept="image/*">
                                                <label class="custom-file-label" for="upload_image">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 pt-2">
                                    <div class="card">
                                        <div class="card-header" id="card-header">
                                            <h3 class="card-title text-center" data-card-widget="collapse"><b>Profile Image Preview</b></h3>
                                        </div>
                                        <div class="card-body text-center my-1">
                                            <img src="<?php echo $rowinfo['ava_location']?>" alt="Sample" class="profile-user-img img-fluid img-circle" alt="User profile picture">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-header" id="card-header">
                                            <h3 class="card-title text-center" data-card-widget="collapse"><b>Change Account Information</b></h3>
                                        </div>
                                        <form method="post">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label class="form-label">First Name</label>
                                                    <input type="text" name="fname" id="fname" class="form-control" value="<?php echo $rowinfo['fname'];?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Middle Initial</label>
                                                    <input type="text" name="mname" id="mname" class="form-control" value="<?php echo $rowinfo['mname'];?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Last Name</label>
                                                    <input type="text" name="lname" id="lname" class="form-control" value="<?php echo $rowinfo['lname'];?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Username</label>
                                                    <input type="tel" name="userid" id="userid" class="form-control" value="<?php echo $rowinfo['username'];?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Position</label>
                                                    <input type="tel" name="position" id="position" class="form-control" value="<?php echo $rowinfo['status'];?>" required>
                                                </div>
                                                <button type="submit" class="chng_sch btn btn-dark btn-sm elevation-3" id="button-all"><i class="fas fa-save"></i> Update</button>
                                            </div>
                                        </form> 
                                    </div> 
                                </div> 
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-header" id="card-header">
                                            <h3 class="card-title text-center" data-card-widget="collapse"><b>Change Password</b></h3>
                                        </div>
                                        <form method="post">
                                            <div class="card-body">
                                                <div class="form-group">
                                                <label class="form-label">Current Password</label>
                                                <input type="password" name="currentPassword" id="currentPassword" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                <label class="form-label">New Password</label>
                                                <input type="password" name="newPassword" id="newPassword" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                <label class="form-label">Confirm Password</label>
                                                <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                <input type="checkbox" onclick="myFunction()"> Show Password
                                                </div>
                                                <button type="submit" class="update_pass btn btn-dark btn-sm elevation-3" data-name="<?php echo $id;?>" id="button-all"><i class="fas fa-save"></i> Update</button>
                                            </div>
                                        </form> 
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
<div id="uploadimageModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title">Crop Profile Picture</p>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 text-center">
                            <div id="image_demo"></div>
                        </div>
                        <div class="btn-group col-lg-12" id="index-color1">
                            <button class="btn crop_image btn-sm"><i class="fas fa-crop"></i> Crop & Upload Image</button>
                            <button class="btn  btn-sm" data-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){

    $(function () {
    bsCustomFileInput.init();
    });

    $image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
      width:200,
      height:200,
      type:'circle'
    },
    boundary:{
      width:300,
      height:300
    }
  });

  $('#upload_image').on('change', function(){
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
    $('#uploadimageModal').modal('show');
  });

  $('.crop_image').click(function(event){
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
      $.ajax({
        url:'uploadavatar.php',
        type:'POST',
        data:{"image":response},
        success:function(data){
           
         location.reload();
        }
      })
    });
  });

    $(document).on('click','.chng_sch', function(){

        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var mname = $('#mname').val();
        var userid = $('#userid').val();
        var position = $('#position').val();

        var action = "chng_sch_info";

        $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action,fname:fname, 
        lname:lname,mname:mname,
        userid:userid,position:position},
        success:function(data)
        {
        }
        });
    });

    $(document).on('click','.update_pass', function(){

        var currentPassword = $('#currentPassword').val();
        var newPassword = $('#newPassword').val();
        var confirmPassword = $('#confirmPassword').val();

        var action = "updatepass";

        $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action,
        currentPassword:currentPassword,
        newPassword:newPassword,
        confirmPassword:confirmPassword},
        success:function(data)
        {

        }
        });
        });

});
</script>