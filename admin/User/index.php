<?php
    include "../include/navigationheader1.php";
    include "../include/css.php";
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1><img src="../../img/user-account.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"> <b>User Account</b> 
                            <ol class="breadcrumb float-sm-right" style="font-size:15px;">
                                <li class="breadcrumb-item"><a href="../index.php"><i class="fas fa-home"></i> Home</a></li>
                                <li class="breadcrumb-item active">User Account</li>
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
                            <h3 class="card-title"><i class="fas fa-address-book"></i> List of User Account</h3>
                        </div>
                        <div class="card-body p-1 pt-2">
                            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                <li class="nav-item">
                                    <button class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false"><span class="round-tabs two"><i class="fas fa-chalkboard-teacher"> </i></span> Faculty</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false"><span class="round-tabs two"><i class="fas fa-id-card"></i></span> Student</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="custom-content-below-tabContent">
                                <div class="tab-pane fade show active" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                    <div class="table-responsive px-2 pt-3">
                                        <table id="data_table1" class="table table-striped table-bordered table-sm" >
                                            <thead>
                                                <tr>
                                                <th>No.</th>
                                                <th>Username</th>    
                                                <th>Full Name</th>
                                                <th>Level</th>
                                                <th>Status</th>
                                                <th>Reset Password</th>
                                                <th>Remove</th>
                                                <th>Trigger</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $usersquery = mysqli_query($conn,"SELECT * FROM userdata WHERE level='faculty' except SELECT * FROM userdata where level='admin' except SELECT * FROM userdata where level='scholarship' order by username DESC"); 
                                                
                                                $count = 1;
                                                while($row = mysqli_fetch_assoc($usersquery)){
                                            ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo $row['username'];?></td>
                                                <td><?php echo $row['lname'];?>, <?php echo $row['fname'];?> <?php echo $row['mname'];?>.</td>
                                                <td><?php echo $row['level'];?></td>
                                                <td><span class="dot" style="background-color: <?= ($row['status'] == 'Enabled' ? '#1B5E20' : 'red'); ?>"></span> &nbsp;&nbsp;&nbsp;<?php echo $row['status'];?></td>
                                                <td><a type="button" class="reset_user_pass btn btn-primary btn-sm elevation-3" data-id="<?php echo $row['id'];?>" data-username="<?php echo $row['username'];?>"><i class="fas fa-key"></i> Reset</a></td>
                                                <td><a type="button" class="delete_user btn btn-primary btn-sm btn-danger elevation-3" data-id="<?php echo $row['id'];?>"><i class="fas fa-trash-alt"></i></a></td>
                                                <td>
                                                <a type="button" class="status btn btn-dark btn-sm elevation-3" data-id="<?php echo $row['id'];?>" data-status="Enabled" style="background-color: #1B5E20;"><i class="fas fa-toggle-on"></i></a>
                                                <a type="button" class="status btn btn-primary btn-sm btn-warning elevation-3" data-id="<?php echo $row['id'];?>" data-status="Disabled" ><i class="fas fa-ban"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel" aria-labelledby="custom-content-below-messages-tab">
                                    <div class="table-responsive px-2 pt-3">
                                        <table id="data_table2" class="table table-striped table-bordered table-sm" >
                                            <thead>
                                                <tr>
                                                <th>No.</th>
                                                <th>Username</th>
                                                <th>Full Name</th>
                                                <th>Level</th>
                                                <th>Status</th>
                                                <th>Reset Password</th>
                                                <th>Remove</th>
                                                <th>Trigger</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $usersquery = mysqli_query($conn,"SELECT * FROM userdata WHERE level='student' except SELECT * FROM userdata where level='admin' except SELECT * FROM userdata where level='scholarship' order by username DESC"); 
                                                
                                                $count = 1;
                                                while($row = mysqli_fetch_assoc($usersquery)){
                                            ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td width="10%"><?php echo $row['username'];?></td>
                                                <td width="20%"><?php echo $row['lname'];?>, <?php echo $row['fname'];?> <?php echo $row['mname'];?>.</td>
                                                <td width="10%"><?php echo $row['level'];?></td>
                                                <td><span class="dot" style="background-color: <?= ($row['status'] == 'Enabled' ? '#1B5E20' : 'red'); ?>"></span> &nbsp;&nbsp;&nbsp;<?php echo $row['status'];?></td>
                                                <td><a type="button" class="reset_user_pass btn btn-primary btn-sm elevation-3" data-id="<?php echo $row['id'];?>" data-username="<?php echo $row['username'];?>"><i class="fas fa-key"></i> Reset</a></td>
                                                <td><a type="button" class="delete_user btn btn-primary btn-sm btn-danger elevation-3" data-id="<?php echo $row['id'];?>"><i class="fas fa-trash-alt"></i></a></td>
                                                <td>
                                                <a type="button" class="status btn btn-dark btn-sm elevation-3" data-id="<?php echo $row['id'];?>" data-status="Enabled" style="background-color: #1B5E20;"><i class="fas fa-toggle-on"></i></a>
                                                <a type="button" class="status btn btn-primary btn-sm btn-warning elevation-3" data-id="<?php echo $row['id'];?>" data-status="Disabled" ><i class="fas fa-ban"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                            </tbody>
                                        </table>
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
<script type="text/javascript">

$(document).ready(function(){

    $('#data_table').DataTable();
    $('#data_table1').DataTable();
    $('#data_table2').DataTable();

    $(document).on("click", ".reset_user_pass", function(){
            
        var user_id = $(this).data("id");
        var username = $(this).data("username");
        var action = "reset_pass";

        Swal.fire({
        title: 'Are you sure?',
        text: "Password of the User back to default password",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Reset it!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url:"action.php",
                method:"POST",
                data:{action:action, user_id:user_id,username:username},
                success:function(data)
                {
                    Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Reset Password of User Successful!',
                    showConfirmButton: false,
                    timer: 2000
                    }).then((result) => {
                        location.reload(true);
                    });
                }
            });
        }
        })
        
    });


    $(document).on("click", ".delete_user", function(){
            
        var user_id = $(this).data("id");

       var action = "delete";

       Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url:"action.php",
                method:"POST",
                data:{action:action, user_id:user_id},
                success:function(data)
                {
                    Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Delete User Account Successful!',
                    showConfirmButton: false,
                    timer: 2000
                    }).then((result) => {
                        location.reload(true);
                    });
                }
            });
            
        }
        })
    });
    $(document).on("click", ".status", function(){
        
        var user_id = $(this).data("id");
        var status = $(this).data("status");

        var action = "status";
        Swal.fire({
        title: 'Are you sure?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url:"action.php",
                method:"POST",
                data:{action:action, user_id:user_id,status:status},
                success:function(data)
                {
                    Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: data,
                    showConfirmButton: false,
                    timer: 2000
                    }).then((result) => {
                        location.reload(true);
                    });
                }
            });
        }
        })

    });
});
</script>