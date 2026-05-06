<?php
    include "include/navigationheader.php"; 
?>
<div class="content-wrapper" style="padding-top: 75px">
    <section class="content p-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                <div class ="card" id="index-color">
                    <div class="card-header">
                    <div class="d-flex align-items-center">
                        <button type="button" onclick="history.go(-1);" class="float-left btn btn-sm"><i class="fas fa-arrow-left" id="arrow-back"></i></button>
                        <h3 class="card-title w-100"><img src="img/useraccount.png" height="24px" witdh="24px"> Account Settings</h3>
                    </div>
                    </div>
                </div>
                    <?php
                        include "alert.php";
                    ?>
                    <div class="container-fluid p-0">
                        <div class="row d-flex">
                            <div class="col-sm-6">
                                <div class="card" id="index-color1">
                                    <div class="text-center py-3">
                                        <img src="<?php echo $rowavatar['ava_location'];?>" alt="Empty" class="profile-user-img img-fluid img-circle" id="icon-img-shadow">
                                    </div>
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-header" id="card-header1">
                                        <h3 class="card-title text-center" data-card-widget="collapse"><b>Change Account Photo</b></h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputFile">File input</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="upload_image" id="upload_image" accept="image/*" />
                                                    <label class="custom-file-label" for="upload_image">Choose Photo</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-header" id="card-header1">
                                        <h3 class="card-title text-center" data-card-widget="collapse"><b>Change Account Name</b></h3>
                                    </div>
                                    <form method="post">
                                        <div class="card-body">
                                            <div class="form-group my-2">
                                            <label class="form-label">First Name</label>
                                            <input type="text" name="fname" id="fname" class="form-control" value="<?php echo $rowavatar['fname'];?>"required>
                                            </div>
                                            <div class="form-group my-2">
                                            <label class="form-label">Middle Initial</label>
                                            <input type="text" name="mname" id="mname" class="form-control" maxlength="2" value="<?php echo $rowavatar['mname'];?>" required>
                                            </div>
                                            <div class="form-group my-2">
                                            <label class="form-label">Last Name</label>
                                            <input type="tel" name="lname" id="lname" class="form-control" value="<?php echo $rowavatar['lname'];?>" required>
                                            </div>
                                        <button type="submit" class="up_stud btn btn-sm elevation-3" id="index-color1"><i class="fas fa-save"></i> Update</button>
                                        </div>
                                    </form> 
                                </div> 
                            </div> 
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-header" id="card-header1">
                                        <h3 class="card-title text-center" data-card-widget="collapse"><b>Change Password</b></h3>
                                    </div>
                                    <form method="post">
                                        <div class="card-body">
                                            <div class="form-group my-2">
                                            <label class="form-label">Current Password</label>
                                            <input type="password" name="currentPassword" id="currentPassword" class="form-control" required>
                                            </div>
                                            <div class="form-group my-2">
                                            <label class="form-label">New Password</label>
                                            <input type="password" name="newPassword" id="newPassword" class="form-control" required>
                                            </div>
                                            <div class="form-group my-2">
                                            <label class="form-label">Confirm Password</label>
                                            <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" required>
                                            </div>
                                            <div class="form-group my-2">
                                            <input type="checkbox" onclick="myFunction()"> Show Password
                                            </div>
                                        <button type="submit" class="update_pass btn btn-sm elevation-3" id="index-color1"><i class="fas fa-save"></i> Update</button>
                                        </div>
                                    </form> 
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
          location.reload(true);
        }
      })
    });
  });

    $(document).on('click','.up_stud', function(){

        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var mname = $('#mname').val();

        var action = "updateuser";

        $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action,fname:fname, 
        lname:lname,mname:mname},
        success:function(data){ location.reload(true);}
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
        data:{action:action,currentPassword:currentPassword, newPassword:newPassword,confirmPassword:confirmPassword},
        success:function(data){ location.reload(true);}
            });
    });

});
</script>
