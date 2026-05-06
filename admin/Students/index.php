<?php
    include('../include/navigationheader1.php'); 
    $studentQ = mysqli_query($conn,"SELECT * FROM student ORDER BY course AND year ASC");
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1><img src="../../img/facultystud.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"> <b>Student</b> 
                            <ol class="breadcrumb float-sm-right" style="font-size:15px;">
                                <li class="breadcrumb-item"><a href="../index.php"><i class="fas fa-home"></i> Home</a></li>
                                <li class="breadcrumb-item active">Student</li>
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
                        <div class="card-header" id="card-header">
                            <button type="button" class="btn float-left btn-sm"><h5 class="card-title" style="color: white;"><i class="fas fa-plus-circle"></i> <b>Add New Student</b></h5></button> 
                            <button type="button" data-card-widget="collapse" class="btn btn-sm float-right" id="button-all"><i class="fas fa-caret-down"></i></button>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype='multipart/form-data' class="row">
                                <div class="col-md-3">
                                    <label class="form-label">Student ID</label>
                                    <input type="tel" class="form-control" name="studid" id="studid" maxlength="9" placeholder = "xx-xxxx-x" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" placeholder="First Name" name="fname" id="fname" style="text-transform: capitalize;" required>
                                </div>
                                <div class="col-md-3 pt-2">
                                    <label class="form-label"></label>
                                    <input type="text" class="form-control" placeholder="Middle Initial" name="mname" id="mname" maxlength="2" style="text-transform: capitalize;" required>
                                </div>
                                <div class="col-md-3 pt-2">
                                    <label class="form-label"></label>
                                    <input type="text" class="form-control" placeholder="Last Name" name="lname" id="lname" style="text-transform: capitalize;" required>
                                </div>
                                <div class="col-md-3 pt-3">
                                    <label class="form-label">School Email</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="abscd@csav.edu.ph" required>
                                </div>
                                <div class="col-md-3 pt-3">
                                    <label class="form-label">Course</label>
                                    <select id="course" name="course" class="form-control select2" required>
                                    <option value="" selected disabled>Select Course</option>
                                    <?php
                                        $result_course = mysqli_query($conn, "SELECT * FROM course");
                                        while($row2 = mysqli_fetch_assoc($result_course)){
                                    ?>
                                        <option value = "<?php echo $row2['course_name'];?>"><?php echo $row2['course_name'];?></option>
                                    <?php
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="col-md-2 pt-3">
                                    <label class="form-label">Year</label>
                                    <select id="year" name="year" class="form-control select2" required>
                                    <option value="" selected disabled>Select Year</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    </select>
                                </div>
                                <div class="col-md-2 pt-3">
                                    <label class="form-label">Section</label>
                                    <select id="section" name="section" class="form-control select2" required>
                                    <option value="" selected disabled>Select Section</option>
                                    <option>A</option>
                                    <option>B</option>
                                    <option>C</option>
                                    <option>D</option>
                                    <option>E</option>
                                    </select>
                                </div>
                                <div class="col-md-2 pt-3">
                                    <label class="form-label">Gender</label>
                                    <select id="gender" name="gender" class="form-control select2" required>
                                    <option value="" selected disabled>Select Gender</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    </select>
                                </div>
                                <div class="col-md-12 pt-3 text-right">
                                    <button type="submit"  name="addstudent" class="add_student btn btn-sm btn-dark elevation-3" id="button-all"><i class="fas fa-user-plus"></i> Add</button>
                                    <input type="hidden" name="studentname" id="studentname"/>
                                    <input type="hidden" name="action" id="action"/>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                        <h3 class="card-title"><i class="far fa-list-alt"></i> List of Students</h3>
                        </div>
                        <div class="table-responsive px-2 pt-3">
                            <table id="data_table" class="table table-striped table-bordered table-sm" >
                                <thead>
                                    <th>No.</th> 
                                    <th>Student ID#</th>
                                    <th>Full Name</th>
                                    <th>Course</th>
                                    <th>Year</th>
                                    <th>Section</th>
                                    <th>Email</th>
                                    <th>Sex</th>
                                    <th>Add Account</th>
                                    <th class="text-center">Option</th> 
                                </thead>
                                <tbody>
                                <?php 
                                    $count = 1;
                                    while($row = mysqli_fetch_array($studentQ)){ 
                                ?>
                                    <tr>
                                        <td ><?php echo $count++;?></td>
                                        <td style="vertical-align: middle;"><?php echo $row['studid'];?></td>
                                        <td style="vertical-align: middle;"><?php echo $row['lname'];?>, <?php echo $row['fname'];?> <?php echo $row['mname'];?>.</td>
                                        <td style="vertical-align: middle;"><?php echo $row['course'];?></td>
                                        <td style="vertical-align: middle;"><?php echo $row['year'];?></td>
                                        <td style="vertical-align: middle;"><?php echo $row['section'];?></td>
                                        <td style="vertical-align: middle;"><?php echo $row['email'];?></td>
                                        <td style="vertical-align: middle;"><?php echo $row['gender'];?></td>
                                        <td><button type="button" class="addacc btn btn-sm btn-primary elevation-3" data-id="<?php echo $row['studid'];?>" data-fname="<?php echo $row['fname'];?>" data-lname="<?php echo $row['lname']; ?>" data-mname="<?php echo $row['mname']; ?>" data-dbid="<?php echo $row['userid'];?>"><i class="fas fa-plus-square"></i></button></td>
                                        <td style="vertical-align: middle;" class="text-center">
                                        <a class="btn btn-primary btn-sm btn-primary elevation-3" href="student_record.php?studid=<?php echo $row['id'];?>"><i class="fas fa-eye"></i></a>
                                        <button class="update_stud btn btn-primary btn-sm btn-secondary elevation-3"
                                            data-name="<?php echo $row['id'];?>" 
                                            data-studid= "<?php echo $row['studid'];?>" 
                                            data-fname = "<?php echo $row['fname'];?>" 
                                            data-mname = "<?php echo $row['mname'];?>"
                                            data-lname="<?php echo $row['lname'];?>"
                                            data-course="<?php echo $row['course'];?>"
                                            data-email="<?php echo $row['email'];?>"
                                            data-gender="<?php echo $row['gender'];?>"
                                            data-year="<?php echo $row['year'];?>"
                                            data-section="<?php echo $row['section'];?>"
                                            data-toggle="modal" data-target="#updatemodal"><i class="fas fa-edit"></i></button>
                                        <button class="delete_student btn btn-primary btn-sm btn-danger elevation-3"  data-id="<?php echo $row['id'];?>" data-name="<?php echo $row['studid'];?>"><i class="fas fa-trash-alt"></i></button>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="header pl-3 pt-3">
                <h5 class="title"><b><i class="fas fa-edit"></i> Update Student Information</b></h5>
            </div>
            <div class="modal-body">
            <p id="msg"></p>
                <form method="post" id="update_form" enctype='multipart/form-data' class="row g-3">
                <div class="col-md-3 pt-3">
                    <label class="form-label">Student ID</label>
                    <input type="tel" class="form-control" name="upstudid" id="upstudid" maxlength="9" placeholder = "xx-xxxx-x" required>
                </div>
                <div class="col-md-3 pt-3">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-control" name="upfname" id="upfname" style="text-transform: capitalize;" required>
                </div>
                <div class="col-md-3 pt-3">
                    <label class="form-label">Middle Initial</label>
                    <input type="text" class="form-control" name="upmname" id="upmname" maxlength="2" style="text-transform: capitalize;" required>
                </div>
                <div class="col-md-3 pt-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="uplname" id="uplname" style="text-transform: capitalize;" required>
                </div>
                <div class="col-md-6 pt-3">
                    <label class="form-label">School Email</label>
                    <input type="email" class="form-control" name="upemail" id="upemail" placeholder="abscd@csav.edu.ph" required>
                </div>
                <div class="col-md-3 pt-3">
                    <label class="form-label">Course</label>
                    <select id="upcourse" name="upcourse" class="form-control select2" required>
                    <option value="" selected disabled>Select Course</option>
                    <?php
                        $result_course = mysqli_query($conn, "SELECT * FROM course");
                        while($row2 = mysqli_fetch_assoc($result_course)){
                    ?>
                        <option value = "<?php echo $row2['course_name'];?>"><?php echo $row2['course_name'];?></option>
                    <?php
                        }
                    ?>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    <label class="form-label">Year</label>
                    <select id="upyear" name="upyear" class="form-control select2" required>
                    <option value="" selected disabled>Select Year</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    <label class="form-label">Section</label>
                    <select id="upsection" name="upsection" class="form-control select2" required>
                    <option value="" selected disabled>Select Section</option>
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                    <option>D</option>
                    <option>E</option>
                    </select>
                </div>
                <div class="col-md-3 pt-3">
                    <label class="form-label">Gender</label>
                    <select id="upgender" name="upgender" class="form-control select2" required>
                    <option value="" selected disabled>Select Gender</option>
                    <option>Male</option>
                    <option>Female</option>
                    </select>
                </div>
                <div class="col-md-12 pt-3">
                    <button type="submit"  name="updatestudent" id="updatestudent" class="btn btn-sm btn-dark elevation-3"><i class="fas fa-save"></i> Update</button>
                    <button type="button" class="btn btn-danger btn-sm float-right elevation-3" data-dismiss="modal"><i class="fas fa-times-circle"></i></button>
                    <input type="hidden" name="stud_id" id="stud_id"/>
                    <input type="hidden" name="action" id="action"/>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

     var tele = document.querySelector('#studid');

    tele.addEventListener('keyup', function(e){

    if (event.key != 'Backspace' && (tele.value.length == 2 || tele.value.length == 7)){
    tele.value += '-';
    }
    });

$(document).ready(function(){

    $('#data_table').DataTable();

    $(document).on('click','.add_student', function(e){

            var action = "add_student";

            var studid = $('#studid').val();
            var fname = $('#fname').val();
            var mname = $('#mname').val();
            var lname = $('#lname').val();
            var course = $('#course').val();
            var year = $('#year').val();
            var email = $('#email').val();
            var gender = $('#gender').val();
            var section = $('#section').val();

        $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action,studid:studid, 
        fname:fname,mname:mname,
        lname:lname,course:course,
        year:year,email:email,
        gender:gender,section:section},
        success: function(data)
        {
        }
        });
    });

    $(document).on("click", ".update_stud", function(){

        var stud_id = $(this).data("name");
        var upstudid = $(this).data("studid");
        var upfname = $(this).data("fname");
        var upmname = $(this).data("mname");
        var uplname = $(this).data("lname");
        var upcourse = $(this).data("course");
        var upyear = $(this).data("year");
        var upemail = $(this).data("email");
        var upgender = $(this).data("gender");
        var upsection = $(this).data("section");

        $('#stud_id').val(stud_id);
        $('#upstudid').val(upstudid);
        $('#upfname').val(upfname);
        $('#upmname').val(upmname);
        $('#upcourse').val(upcourse);
        $('#upyear').val(upyear);
        $('#upsection').val(upsection);
        $('#upemail').val(upemail);
        $('#upgender').val(upgender);
        $('#uplname').val(uplname);
        $('#updatemodal').modal('show');
        $('#action').val("change");
    });

    $(document).on('click','#updatestudent', function(){

        var stud_id = $('#stud_id').val();

        var upstudid = $('#upstudid').val();
        var upfname = $('#upfname').val();
        var upmname = $('#upmname').val();
        var uplname = $('#uplname').val();
        var upcourse = $('#upcourse').val();
        var upyear = $('#upyear').val();
        var upemail = $('#upemail').val();
        var upgender = $('#upgender').val();
        var upsection = $('#upsection').val();

        var action = $('#action').val();

        if(stud_id != '')
        {
        $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action,upstudid:upstudid, 
        upfname:upfname,upmname:upmname,
        uplname:uplname,upcourse:upcourse,
        upyear:upyear,upemail:upemail,
        upgender:upgender,stud_id:stud_id,
        upsection:upsection},
        success:function(data){}
        });
        }
        else
        {
        alert("Error");
        }
    });

    $(document).on("click", ".delete_student", function(){
            
        var id = $(this).data("id");
        var stud_id = $(this).data("name");
    
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
            data:{action:action, id:id,stud_id:stud_id},
            success:function(data)
            {
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Delete Student Successful!',
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

    var stud_id = $(this).data("id");
    var lname = $(this).data("lname");
    var fname = $(this).data("fname");
    var mname = $(this).data("mname");
    var dbid = $(this).data("dbid");

    var action = "add_account";

        $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action,stud_id:stud_id,
            lname:lname,fname:fname,mname:mname,dbid:dbid},
        success:function(data)
        {
            location.reload();
        }
        });
    });
});
</script>