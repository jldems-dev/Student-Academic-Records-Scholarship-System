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
                            <h1> <img src="../../img/facultyprofile.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"> My Profile
                            <ol class="breadcrumb float-sm-right" style="font-size:15px;">
                                <li class="breadcrumb-item"><a href="../index.php"><i class="fas fa-home"></i> Home</a></li>
                                <li class="breadcrumb-item active">My Profile</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-address-card"></i> Profile Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid text-center">
                                <div class="card px-2 pt-2">
                                    <img src="<?php echo $row1['ava_location']?>" alt="Sample" class="profile-user-img img-fluid img-circle" alt="User profile picture">
                                    <div class="dropdown-divider"></div>
                                    <p>
                                    <b>Full Name</b><br/>
                                    <input type="text" class="text-center" value="<?php echo $row['fname'];?> <?php echo $row['mname'];?>. <?php echo $row['lname'];?>" disabled/> <br/>
                                    <b>ID #</b><br/>
                                    <input type="text" class="text-center" value=" <?php echo $row['teachid'];?>" disabled><br/>
                                    <b>Sex</b><br/>
                                    <input type="text" class="text-center" value="<?php echo $row['gender'];?>" disabled><br/>
                                    <b>Status</b><br/>
                                    <input type="text" class="text-center" value="<?php echo $row['status'];?>" disabled><br/>
                                    <b>Email</b><br/>
                                    <input type="text" class="text-center col-sm-3" value="<?php echo $row['email'];?>" disabled><br/>
                                    <b>Consultation Time</b>
                                    <div style=" padding-left: 37%;">
                                    <div contenteditable="true" data-id="<?php echo $row['id'];?>" style="border: 1px solid;" class="update col-sm-5 text-center"><?php echo $row['consultation_time'];?></div>
                                    </div>
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
    </section>
</div>
<script>
    $(function () {
    bsCustomFileInput.init();
    });
    $('#first_table').DataTable();

    $(document).on('blur', '.update', function(){

    var id = $(this).data("id");
    var value = $(this).text();

    var action = "update_constime";

    $.ajax({
    url:"action.php",
    method:"POST",
    data:{action:action,value:value,id:id},
    success:function(data)
    {
        toastr.success(data);
    }
    });
    });

</script>