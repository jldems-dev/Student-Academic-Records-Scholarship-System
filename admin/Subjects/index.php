<?php
    include "../include/navigationheader1.php";

    $subjectQ = mysqli_query($conn,"SELECT * FROM subject_record");
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1> <img src="../../img/facultysub.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"> <b>Subject</b> 
                            <ol class="breadcrumb float-sm-right" style="font-size:15px;">
                                <li class="breadcrumb-item"><a href="../index.php"><i class="fas fa-home"></i> Home</a></li>
                                <li class="breadcrumb-item active">Subject</li>
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
                            <button type="button" class="btn float-left btn-sm"><h5 class="card-title" style="color: white;"><i class="fas fa-plus-circle "></i> <b>Add Course Subject Record</b></h5></button> 
                            <button type="button" class="btn float-right btn-sm" data-card-widget="collapse" id="card-header"><i class="fas fa-caret-down"></i></button>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype='multipart/form-data' class="row">
                                <div class="col-md-4">
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
                                <div class="col-md-4">
                                    <label class="form-label">Year</label>
                                    <select id="year" name="year" class="form-control select2" required>
                                    <option value="" selected disabled>Select Year</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Semester</label>
                                    <select id="semester" name="semester" class="form-control select2" required>
                                    <option value="" selected disabled>Select Semester</option>
                                    <option>1st</option>
                                    <option>2nd</option>
                                    <option>Summer</option>
                                    </select>
                                </div>
                                <div class="col-md-12 pt-3 text-right">
                                    <button type="submit" class="add_subj_record btn btn-sm btn-dark elevation-3" id="button-all"><i class="fas fa-plus-square"></i> Add</button>
                                    <input type="hidden" name="subjectname" id="subjectname"/>
                                    <input type="hidden" name="action" id="action"/>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="far fa-list-alt"></i> List of Records</h3>
                        </div>
                        <div class="table-responsive px-2 pt-3">
                            <table id="data_table" class="table table-striped table-bordered table-sm" >
                                <thead>
                                    <th>Course</th>
                                    <th>Year</th>
                                    <th>Semester</th>
                                    <th>Subject List</th>
                                    <th class="text-center">Option</th> 
                                </thead>
                                <tbody>
                                <?php $count = 1;?>
                                <?php while($row = mysqli_fetch_array($subjectQ)): ?>
                                    <tr>
                                        <td style="vertical-align: middle;"><?php echo $row['course'];?></td>
                                        <td style="vertical-align: middle;"><?php echo $row['year'];?></td>
                                        <td style="vertical-align: middle;"><?php echo $row['semester'];?></td>
                                        <td><a type="button" class="btn btn-sm btn-primary elevation-3" href="record_subject_list.php?recordid=<?php echo $row['id']?>"><i class="fas fa-th-list"></i></a></td>
                                        <td style="vertical-align: middle;" class="text-center">
                                        <button class="update_sub btn btn-primary btn-sm btn-secondary elevation-3" 
                                        data-name="<?php echo $row['id'];?>" 
                                        data-course = "<?php echo $row['course'];?>" 
                                        data-year = "<?php echo $row['year'];?>" 
                                        data-semester = "<?php echo $row['semester'];?>" 
                                        data-toggle="modal" data-target="#updatemodal"><i class="fas fa-edit"></i></button>
                                        <button class="delete_record btn btn-primary btn-sm btn-danger elevation-3"  data-id="<?php echo $row['id'];?>"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="header pl-3 pt-3">
                <h5 class="title"><b><i class="fas fa-edit"></i> Update Course Subject Record</b></h5>
            </div>
            <div class="modal-body">
                <form method="post" id="update_form" enctype='multipart/form-data' class="row">
                    <div class="col-md-4 pt-3">
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
                    <div class="col-md-4 pt-3">
                        <label class="form-label">Year</label>
                        <select id="upyear" name="upyear" class="form-control select2" required>
                        <option value="" selected disabled>Select Year</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        </select>
                    </div>
                    <div class="col-md-4 pt-3">
                        <label class="form-label">Semester</label>
                        <select id="upsemester" name="upsemester" class="form-control select2" required>
                        <option value="" selected disabled>Select Semester</option>
                        <option>1st</option>
                        <option>2nd</option>
                        <option>Summer</option>
                        </select>
                    </div>
                    <div class="col-md-12 pt-3">
                        <button type="submit"  name="updatesub" id="button-all" class="btn btn-sm btn-dark elevation-3"><i class="fas fa-save"></i>&nbsp;Update</button>
                        <button type="submit" class="btn btn-danger float-right btn-sm elevation-3" data-dismiss="modal"><i class="fas fa-times-circle"></i></button>
                        <input type="hidden" name="action" id="action"/>
                        <input type="hidden" name="record_id" id="record_id"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

$(document).ready(function(){

    $('#data_table').DataTable();

    $(document).on("click", ".add_subj_record", function(){

        var action = "add_subject_record";
        var course = $('#course').val();
        var year = $('#year').val();
        var semester = $('#semester').val();

        $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action,course:course,
        year:year,semester:semester},
        success: function(data)
        {
        }
        });
    });
    $(document).on("click", ".update_sub", function(){

        var record_id = $(this).data("name");
        var upcourse = $(this).data("course");
        var upyear = $(this).data("year");
        var upsemester = $(this).data("semester");

        $('#record_id').val(record_id);
        $('#upcourse').val(upcourse);
        $('#upyear').val(upyear);
        $('#upsemester').val(upsemester);
        $('#updatemodal').modal('show');
        $('#action').val("update_subject_record");
        $('#updatesub').val('Update');
    });

    $('#update_form').on('submit', function(){

        var record_id = $('#record_id').val();
        var upcourse = $('#upcourse').val();
        var upyear = $('#upyear').val();
        var upsemester = $('#upsemester').val();

        var action = $('#action').val();

        if(record_id != '')
        {
        $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action,record_id:record_id,
        upcourse:upcourse,upyear:upyear,
        upsemester:upsemester},
        success:function(data)
        {
        $('#updatemodal').modal('hide');
        }
        });
        }
        else
        {
        alert("Error");
        }
    });

    $(document).on("click", ".delete_record", function(){
            
        var recordid = $(this).data("id");
    
        var action = "delete_record";
    
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
                title: 'Delete Course Subject Record Successful!',
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
});
</script>