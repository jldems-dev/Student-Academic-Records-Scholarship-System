<?php
    include('../include/navigationheader1.php'); 

        $student_id = $_GET['studid'];
        $studentinfo = mysqli_query($conn, "SELECT * FROM student WHERE id='$student_id'");
        $rowinfo = mysqli_fetch_assoc($studentinfo);

        $studentrecord = mysqli_query($conn, "SELECT * FROM student_record WHERE studid='$student_id' ORDER BY sy ASC");
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1><i class="far fa-clipboard"></i> <b>Record of Student Grades</b>
                            <ol class="breadcrumb float-sm-right" style="font-size:15px;">
                                <li class="breadcrumb-item"><a href="../index.php"><i class="fas fa-home"></i> Home</a></li>
                                <li class="breadcrumb-item active">Student</li> <li class="breadcrumb-item active">Record Grades of Student</li>
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
                            <h3 class="card-title"><i class="far fa-list-alt"></i> Student Record List</h3>
                        </div>
                        <div class="pt-3 ml-2">
                            <p>
                                <b>STUDENT ID#: </b>&emsp;&emsp;&nbsp;<?php echo $rowinfo['studid'];?><br>
                                <b>FULL NAME: </b>&emsp;&emsp;&emsp;<?php echo $rowinfo['fname'];?> <?php echo $rowinfo['mname'];?>. <?php echo $rowinfo['lname'];?><br>
                                <b>COURSE: </b>&emsp;&emsp;&emsp;&emsp;&ensp;<?php echo $rowinfo['course'];?><br>
                                <b>YEAR & SECTION: </b>&emsp;<?php echo $rowinfo['year'];?>-<?php echo $rowinfo['section'];?>
                            </p>
                        </div>
                        <div class="table-responsive px-2 pt-3">
                            <table id="data" class="table table-striped table-bordered table-sm" >
                                <thead>
                                    <th>Student Year</th>
                                    <th>Semester</th>
                                    <th>SY</th>
                                    <th>Enrolled Subject</th>
                                    <th>Option</th>
                                </thead>
                                <?php
                                    $count=1;
                                    while ($row = mysqli_fetch_assoc($studentrecord)){
                                ?>
                                <tbody>
                                    <td width="10%"><?php echo $row['stud_year']?></td>
                                    <td width="10%"><?php echo $row['sem']?></td>
                                    <td><?php echo $row['sy']?></td>
                                    <td width="15%"><a class="update_stud btn btn-primary btn-sm btn-primary elevation-3" href="student_subject.php?studid=<?php echo $student_id;?>&recordid=<?php echo $row['id']?>&sem=<?php echo $row['sem']?>&sy=<?php echo $row['sy']?>&year=<?php echo $row['stud_year'];?>"><i class="fas fa-eye"></i></a></td>
                                    <td width="10%">
                                        <button class="update_record btn btn-primary btn-sm btn-secondary elevation-3"
                                            data-sem="<?php echo $row['sem'];?>"
                                            data-year="<?php echo $row['stud_year'];?>"
                                            data-sy="<?php echo $row['sy'];?>"
                                            data-record="<?php echo $row['id'];?>"
                                            data-studid="<?php echo $row['studid'];?>"
                                            data-toggle="modal" data-target="#updaterecord"><i class="fas fa-edit"></i>
                                        </button>
                                        <button class="delete_record btn btn-primary btn-sm btn-danger elevation-3"  data-id="<?php echo $row['id'];?>"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tbody>
                                <?php
                                    }
                                ?>
                            </table>
                            <div class="btn-group py-2" >
                                <button class="btn btn-sm btn-dark elevation-3" onclick="location.href='index.php'" id="button-all"><i class="fas fa-backspace"></i> Back </button>
                                <button type="button" class="btn btn-dark btn-sm elevation-3" id="button-all" data-toggle="modal" data-target="#addrecord" data-id="<?php echo $student_id;?>" data-sem="<?php echo $student_id;?>"><i class="fas fa-plus-square"></i> Record</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="addrecord" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="header pl-3 pt-3">
                <h5 class="title"><b><i class="fas fa-plus-square"></i> New Record of Student</b></h5>
            </div>
            <div class="modal-body">
                <form method="post" enctype='multipart/form-data' class="row">
                    <div class="col-md-6 pt-3">
                        <label class="form-label">Student Year</label>
                        <select id="year" name="year" class="form-control" required>
                        <option value="" selected disabled>Select year</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        </select>
                    </div>
                    <div class="col-md-6 pt-3">
                        <label class="form-label">Semester</label>
                        <select id="sem" name="sem" class="form-control" required>
                        <option value="" selected disabled>Select Semester</option>
                        <option>1st</option>
                        <option>2nd</option>
                        <option>Summer</option>
                        </select>
                    </div>
                    <div class="col-md-6 pt-3">
                        <label class="form-label">School Year</label>
                        <select id="sy" name="sy" class="form-control" required>
                        <option value="" selected disabled>Select School Year</option>
                        <?php
                            for( $y = 2000; $y <= 2100; $y++ ) {
                                ?>
                                    <option value="<?php echo $y-1; ?>-<?php echo $y; ?>"><?php echo $y-1; ?>-<?php echo $y; ?></option>
                                <?php
                            }
                        ?>
                        </select>
                    </div>
                    <div class="col-lg-12 pt-3">
                        <button type="submit" class="add_record btn btn-sm btn-dark elevation-3" data-studid="<?php echo $student_id; ?>" id="button-all"><i class="fas fa-save"></i> Add</button>
                        <button type="button" class="btn btn-danger btn-sm float-right elevation-3" data-dismiss="modal"><i class="fas fa-times-circle"></i></button>
                        <input type="hidden" name="action" id="action"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="updaterecord" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="header pl-3 pt-3">
                <h5 class="title"><b><i class="fas fa-edit"></i> Update Record of Student</b></h5>
            </div>
            <div class="modal-body">
                <form method="post" id="upload_form" enctype='multipart/form-data' class="row">
                    <div class="col-md-6 pt-3">
                        <label class="form-label">Student Year</label>
                        <select id="upyear" name="upyear" class="form-control" required>
                        <option value="" selected disabled>Select Year</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        </select>
                    </div>
                    <div class="col-md-6 pt-3">
                        <label class="form-label">Semester</label>
                        <select id="upsem" name="upsem" class="form-control" required>
                        <option value="" selected disabled>Select Semester</option>
                        <option>1st</option>
                        <option>2nd</option>
                        <option>Summer</option>
                        </select>
                    </div>
                    <div class="col-md-6 pt-3">
                        <label class="form-label">School Year</label>
                        <select id="upsy" name="upsy" class="form-control" required>
                        <option value="" selected disabled>Select Year</option>
                        <?php
                            for( $y = 2000; $y <= 2100; $y++ ) {
                                ?>
                                    <option value="<?php echo $y-1; ?>-<?php echo $y; ?>"><?php echo $y-1; ?>-<?php echo $y; ?></option>
                                <?php
                            }
                        ?>
                        </select>
                    </div>
                    <div class="col-lg-12 pt-3">
                        <button type="submit" class="btn btn-sm btn-dark elevation-3" id="button-all"><i class="fas fa-save"></i> Update</button>
                        <button type="button" class="btn btn-danger btn-sm float-right elevation-3" data-dismiss="modal"><i class="fas fa-times-circle"></i></button>
                        <input type="hidden" name="recordid" id="recordid"/>
                        <input type="hidden" name="action" id="action"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

$('#data').DataTable();

$(document).ready(function(){

    $(document).on("click", ".add_record", function(){

        var studid = $(this).data("studid");
        var action = "add_stud_record";
        var sem = $('#sem').val();
        var sy = $('#sy').val();
        var year = $('#year').val();
    
        $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action,sem:sem,
        sy:sy,year:year,studid:studid},
        success: function(data){
        }
        });
    });

    $(document).on("click", ".update_record", function(){

    var upsem = $(this).data("sem");
    var upsy = $(this).data("sy");
    var upyear = $(this).data("year");
    var recordid = $(this).data("record");
    var studid = $(this).data("studid");

    $('#action').val("uprecord");
    $('#upsem').val(upsem);
    $('#upsy').val(upsy);
    $('#upyear').val(upyear);
    $('#recordid').val(recordid);
    $('#studid').val(studid);

    $('#updaterecord').modal('show');
    });

    $('#upload_form').on('submit', function(){

        var recordid = $('#recordid').val();
        var upsem = $('#upsem').val();
        var upsy = $('#upsy').val();
        var upyear = $('#upyear').val();
        var studid = $('#studid').val();

        var action = $('#action').val();

        if(recordid != '')
        {
        $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action,upsem:upsem, 
        upsy:upsy,upyear:upyear,recordid:recordid,studid:studid},
        success:function(data){}
        });
        }
        else
        {
        alert("Error");
        }
    });

    $(document).on("click", ".delete_record", function(){
            
        var recordid = $(this).data("id");
    
        var action = "deleterecord";
    
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
            data:{action:action, recordid:recordid},
            success:function(data)
            {
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Delete Academic Record of Student Successful!',
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