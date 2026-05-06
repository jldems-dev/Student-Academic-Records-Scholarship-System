<?php
    include "../include/navigationheader1.php";
    $teach_list = mysqli_query($conn,"SELECT * FROM teacher");
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1><img src="../../img/teacher.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"> <b>Faculty</b> 
                            <ol class="breadcrumb float-sm-right" style="font-size:15px;">
                                <li class="breadcrumb-item"><a href="../index.php"><i class="fas fa-home"></i> Home</a></li>
                                <li class="breadcrumb-item active">Faculty</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card collapsed-card">
                        <div class="card-header " id="card-header">
                            <button type="button" class="btn float-left btn-sm"><h5 class="card-title" style="color: white;"><i class="fas fa-plus-circle"></i><b> Add New Faculty</b></h5></button> 
                            <button type="button" class="btn float-right btn-sm" data-card-widget="collapse" id="index-color1"><i class="fas fa-caret-down"></i></button>
                        </div>
                        <div class="card-body">
                            <form method="post" id="upload_form" enctype='multipart/form-data' class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label">Faculty ID#</label>
                                    <input type="tel" class="form-control" name="facultyid" id="facultyid" maxlength="11" placeholder="xxxx-xxxx-x" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="fname" id="fname" style="text-transform: capitalize;"  placeholder="First Name" required>
                                </div>
                                <div class="col-md-3 pt-2">
                                    <label class="form-label"></label>
                                    <input type="text" class="form-control" name="mname" id="mname" maxlength="2" style="text-transform: capitalize;" placeholder="Middle Initial" required>
                                </div>
                                <div class="col-md-3 pt-2">
                                    <label class="form-label"></label>
                                    <input type="text" class="form-control" name="lname" id="lname" style="text-transform: capitalize;" placeholder="Last Name" required>
                                </div>
                                <div class="col-md-3 pt-3">
                                    <label class="form-label">School Email</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="abscd@csav.edu.ph" required>
                                </div>
                                <div class="col-md-3 pt-3">
                                        <label class="form-label">Department</label>
                                        <select id="dpment" name="dpment" class="form-control select2" required>
                                        <option value="" selected disabled>Select Department</option>
                                    <?php
                                        $department = mysqli_query($conn, "SELECT * FROM department");
                                        while ($row=mysqli_fetch_assoc($department)){
                                    ?>
                                        <option value="<?php echo $row['dp_description'];?>"><?php echo $row['dp_description'];?></option>
                                    <?php
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="col-md-3 pt-3">
                                    <label class="form-label">Gender</label>
                                    <select id="gender" name="gender" class="form-control select2" required>
                                    <option value="" selected disabled>Select Gender</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    </select>
                                </div>
                                <div class="col-md-3 pt-3">
                                    <label class="form-label">Status in School</label>
                                    <select id="status" name="status" class="form-control select2" required>
                                    <option value="" selected disabled>Select Status</option>
                                    <option>Full Time</option>
                                    <option>Part Time</option>
                                    <option>Coordinator</option>
                                    </select>
                                </div>
                                <div class="col-md-12 pt-3 text-right">
                                    <button type="submit" name="addteacher" id="addteacher" class="add_teacher btn btn-sm btn-dark elevation-3"><i class="fas fa-user-plus"></i> Add</button>
                                    <input type="hidden" name="action" id="action"/>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card" >
                        <div class="card-header">
                            <h3 class="card-title"><i class="far fa-list-alt"></i> List of Faculty</h3>
                        </div>
                        <div class="table-responsive px-2 pt-3">
                            <table id="data_table" class="table table-striped table-bordered table-sm" >
                                <thead>
                                    <th>No.</th> 
                                    <th>Faculty ID#</th>
                                    <th>Full Name</th>
                                    <th>Department</th>
                                    <th>Sex</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Add Account</th>
                                    <th class="text-center">Option</th> 
                                </thead>
                                <tbody>
                               <?php
                                    $count = 1;
                                    while($row = mysqli_fetch_assoc($teach_list)){ 
                                ?>
                               <tr>
                                    <td><?php echo $count++ ?></td>
                                    <td style="vertical-align: middle;"><?php echo $row['teachid'] ?></td>
                                    <td style="vertical-align: middle;"><?php echo $row['lname']; ?>, <?php echo $row['fname'];?> <?php echo $row['mname'].'.'; ?> </td>
                                    <td style="vertical-align: middle;"><?php echo $row['department']?></td>
                                    <td style="vertical-align: middle;"><?php echo  $row['gender']?></td>
                                    <td style="vertical-align: middle;"><?php echo  $row['email']?></td>
                                    <td style="vertical-align: middle;"><?php echo  $row['status']?></td>
                                    <td><button type="button" class="addacc btn btn-sm btn-primary elevation-3" data-id="<?php echo $row['teachid'];?>" data-fname="<?php echo $row['fname'];?>" data-lname="<?php echo $row['lname']; ?>" data-mname="<?php echo $row['mname']; ?>" data-dbid="<?php echo $row['userid'];?>"><i class="fas fa-plus-square"></i></button></td>
                                    <td style="vertical-align: middle;" class="text-center">
                                    <a class="btn btn-primary btn-sm btn-primary elevation-3" href="faculty_subjectload.php?facultyid=<?php echo  $row['id']?>"><i class="fas fa-eye"></i></a>
                                    <button class="update_teach btn btn-primary btn-sm btn-secondary elevation-3" 
                                        data-name="<?php echo  $row['id']?>" 
                                        data-teachid= "<?php echo  $row['teachid']?>" 
                                        data-fname = "<?php echo  $row['fname']?>" 
                                        data-mname = "<?php echo  $row['mname']?>" 
                                        data-lname="<?php echo  $row['lname']?>"
                                        data-dpment="<?php echo  $row['department']?>"
                                        data-gender="<?php echo  $row['gender']?>"
                                        data-email="<?php echo  $row['email']?>"
                                        data-status="<?php echo  $row['status']?>" data-toggle="modal" data-target="#updatemodal"><i class="fas fa-edit"></i></button>
                                    <button class="delete_teacher btn btn-primary btn-sm btn-danger elevation-3" data-name="<?php echo $row['teachid']?>" data-id="<?php echo $row['id']?>"><i class="fas fa-trash-alt"></i></button>
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
    </section>
</div>
<div class="modal fade" id="updatemodal">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="header pl-3 pt-3">
                <h5 class="title"><b><i class="fas fa-edit"></i> Update Faculty Information</b></h5>
            </div>
            <div class="modal-body">
            <p id="msg" class="text-danger"></p>
                <form method="post" enctype='multipart/form-data' class="row g-3">
                    <div class="col-md-6 pt-3">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" name="upfname" id="upfname" style="text-transform: capitalize;" equired>
                    </div>
                    <div class="col-md-6 pt-3">
                        <label class="form-label">Middle Initial</label>
                        <input type="text" class="form-control" name="upmname" id="upmname" maxlength="2" style="text-transform: capitalize;" required>
                    </div>
                    <div class="col-md-6 pt-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="uplname" id="uplname" style="text-transform: capitalize;" required>
                    </div>
                    <div class="col-md-6 pt-3">
                        <label class="form-label">Faculty ID#</label>
                        <input type="tel" class="form-control" name="upteachid" id="upteachid" maxlength="11" placeholder = "xxxx-xxxx-x" required>
                    </div>
                    <div class="col-md-6 pt-3">
                            <label class="form-label">Department</label>
                            <select id="updpment" name="updpment" class="form-control select2" required>
                            <option value="" selected disabled>Select Department</option>
                        <?php
                            $department = mysqli_query($conn, "SELECT * FROM department");
                            while ($row=mysqli_fetch_assoc($department)){
                         ?>
                            <option value="<?php echo $row['dp_description'];?>"><?php echo $row['dp_description'];?></option>
                        <?php
                            }
                        ?>
                         </select>
                    </div>
                    <div class="col-md-6 pt-3">
                        <label class="form-label">School Email</label>
                        <input type="email" class="form-control" name="upemail" id="upemail" placeholder="abscd@csav.edu.ph" required>
                    </div>
                    <div class="col-md-6 pt-3">
                        <label class="form-label">Sex</label>
                        <select id="upgender" name="upgender" class="form-control select2" required>
                        <option value="" selected disabled>Select Sex</option>
                        <option>Male</option>
                        <option>Female</option>
                        </select>
                    </div>
                    <div class="col-md-6 pt-3">
                        <label class="form-label">Status</label>
                        <select id="upstatus" name="upstatus" class="form-control select2" required>
                        <option value="" selected disabled>Select Status</option>
                        <option>Full Time</option>
                        <option>Part Time</option>
                        <option>Coordinator</option>
                        </select>
                    </div>
                    <div class="col-md-6 pt-3">
                        <button type="submit"  name="updateteacher" id="updateteacher" class="btn btn-sm btn-dark elevation-3"><i class="fas fa-save"></i> Update</button>
                        <input type="hidden" name="teach_id" id="teach_id"/>
                        <input type="hidden" name="action" id="action"/>
                    </div>
                    <div class="col-md-6 pt-3">
                        <button type="submit" class="btn btn-sm btn-danger float-right elevation-3" data-dismiss="modal"><i class="fas fa-times-circle"></i></button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="classload" role="dialog">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
        <div class="modal-body" id="class_list">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  
    var tele = document.querySelector('#facultyid');

    tele.addEventListener('keyup', function(e){

    if (event.key != 'Backspace' && (tele.value.length == 4 || tele.value.length == 9)){
    tele.value += '-';
    }
    });

$(document).ready(function(){

     $('#data_table').DataTable();

    $(document).on('click', '.add_teacher', function(e){

            var action = "add_faculty";
            var facultyid = $('#facultyid').val();
            var fname = $('#fname').val();
            var mname = $('#mname').val();
            var lname = $('#lname').val();
            var status = $('#status').val();
            var email = $('#email').val();
            var gender = $('#gender').val();
            var dpment = $('#dpment').val();

        $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action,facultyid:facultyid,
        fname:fname,mname:mname,
        lname:lname,status:status,
        email:email,gender:gender,
        dpment:dpment},
        success: function(data)
        {
        }
        });
    });

    $(document).on("click", ".update_teach", function(){

        var teach_id = $(this).data("name");
        var upteachid = $(this).data("teachid");
        var upfname = $(this).data("fname");
        var upmname = $(this).data("mname");
        var uplname = $(this).data("lname");
        var updpment = $(this).data("dpment");
        var upgender = $(this).data("gender");
        var upemail = $(this).data("email");
        var upstatus = $(this).data("status");

        $('#teach_id').val(teach_id);
        $('#upteachid').val(upteachid);
        $('#upfname').val(upfname);
        $('#upmname').val(upmname);
        $('#uplname').val(uplname);
        $('#updpment').val(updpment);
        $('#upgender').val(upgender);
        $('#upemail').val(upemail);
        $('#upstatus').val(upstatus);
        $('#updatemodal').modal('show');
        $('#action').val("change");
        $('#updateteacher').val('Update');
    });

    $(document).on('click','#updateteacher', function(){

        var teach_id = $('#teach_id').val();

        var upteachid = $('#upteachid').val();
        var upfname = $('#upfname').val();
        var upmname = $('#upmname').val();
        var uplname = $('#uplname').val();
        var updpment = $('#updpment').val();
        var upgender = $('#upgender').val();
        var upemail = $('#upemail').val();
        var upstatus = $('#upstatus').val();

        var action = $('#action').val();

        if(teach_id != '')
        {
        $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action,upteachid:upteachid, 
        upfname:upfname,upmname:upmname,
        uplname:uplname,updpment:updpment,
        upgender:upgender,upemail:upemail,
        teach_id:teach_id,upstatus:upstatus},
        success:function(data){}
        });
        }
        else
        {
        alert("Error");
        }
    });

    $(document).on('click', '.class_load', function(){

        var id = $(this).data("name");

        $.ajax({
        url:"class_load.php",
        method:"POST",
        data:{id:id},
        success:function(data)
        {
            $('#class_list').html(data);
            $('#classload').modal('show');
        }
        });
    });

    $(document).on("click", ".delete_teacher", function(){
            
        var teacher_id = $(this).data("id");
        var teacherschid = $(this).data("name");
    
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
            data:{action:action, teacher_id:teacher_id,teacherschid:teacherschid},
            success:function(data)
            {
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Delete Faculty Successful!',
                showConfirmButton: false,
                timer: 1500
                }).then((result) => {
                    location.reload(true);
                });
            }
            });
        }
        })
    });

    $(document).on("click", ".addacc", function(){

    var faculty_id = $(this).data("id");
    var lname = $(this).data("lname");
    var fname = $(this).data("fname");
    var mname = $(this).data("mname");
    var dbid = $(this).data("dbid");

    var action = "add_account";

        $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action,faculty_id:faculty_id,
            lname:lname,fname:fname,mname:mname,dbid:dbid},
        success:function(data)
        {
            location.reload();
        }
        });
    });
});

</script>