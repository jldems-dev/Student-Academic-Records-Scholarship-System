<?php
    include('../include/navigationheader1.php');

    $recordid = $_GET['recordid'];
    $recordinfo = mysqli_query($conn,"SELECT * FROM subject_record WHERE id='".$recordid."'");
    $rowinfo = mysqli_fetch_assoc($recordinfo);
    $course = $rowinfo['course'];
    $year = $rowinfo['year'];
    $semester = $rowinfo['semester'];
    $subject_list = mysqli_query($conn,"SELECT * FROM subject WHERE subrecord_id='$recordid'");
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1> <i class="fas fa-book-open"></i> <b>Subject</b> 
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
                            <button type="button" class="btn float-left btn-sm"><h5 class="card-title" style="color: white;"><i class="fas fa-plus-circle"></i> <b>Add New Subject</b></h5></button> 
                            <button type="button" class="btn float-right btn-sm" data-card-widget="collapse" id="card-header"><i class="fas fa-caret-down"></i></button>
                        </div>
                        <div class="card-body">
							<p id="msg" class="text-danger"></p>
                            <form method="post" id="upload_form" enctype='multipart/form-data' class="row">
                                <div class="col-md-3 pt-3">
                                    <label class="form-label">Subject Code</label>
                                    <input type="tel" class="form-control" name="subcode" id="subcode" maxlength="7" style="text-transform:uppercase" required>
                                </div>
                                <div class="col-md-3 pt-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" name="title" id="title" style="text-transform: capitalize;" required>
                                </div>
                                <div class="col-md-3 pt-3">
                                    <label class="form-label">Units</label>
                                    <select id="unit" name="unit" class="form-control" required>
                                        <option value="" selected disabled>Select Units</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                                <div class="col-md-3 pt-3">
                                    <label class="form-label">Credits</label>
                                    <select id="credits" name="credits" class="form-control" required>
                                        <option value="" selected disabled>Select Credits</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                                <div class="col-md-12 pt-3 text-right">
                                    <button type="submit" class="add_subject btn btn-sm btn-dark elevation-3" id="button-all"><i class="fas fa-plus-square"></i> Add</button>
                                    <input type="hidden" name="recordid" id="recordid" value="<?php echo $recordid;?>"/>
                                    <input type="hidden" name="year" id="year" value="<?php echo $year;?>"/>
                                    <input type="hidden" name="course" id="course" value="<?php echo $course;?>"/>
                                    <input type="hidden" name="semester" id="semester" value="<?php echo $semester;?>"/>
                                    <input type="hidden" name="action" id="action"/>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="far fa-list-alt"></i> List of Subjects</h3>
                        </div>
                        <div class="pt-3 ml-2">
                            <p>
                                <b>COURSE: </b>&emsp;&emsp;<?php echo $rowinfo['course'];?><br>
                                <b>YEAR: </b>&emsp;&emsp;&emsp;&nbsp;<?php echo $rowinfo['year'];?><br>
                                <b>SEMESTER:</b>&emsp;<?php echo $rowinfo['semester'];?><br>
                            </p>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive px-2 pt-3">
                                <table id="data_table" class="table table-striped table-bordered table-sm" >
                                    <thead>
                                        <th>No.</th> 
                                        <th>Subject Code</th>    
                                        <th>Subject Description</th>
                                        <th>Course</th>
                                        <th>Year</th>
                                        <th>Semester</th>
                                        <th>Units/Credits</th>
                                        <th class="text-center">Option</th> 
                                    </thead>
                                    <tbody>
                                    <?php $count = 1;?>
                                    <?php while($row = mysqli_fetch_array($subject_list)): ?>
                                        <tr>
                                            <td ><?php echo $count++;?></td>
                                            <td style="vertical-align: middle;"><?php echo $row['code'];?></td>
                                            <td style="vertical-align: middle;"><?php echo $row['title'];?></td>
                                            <td style="vertical-align: middle;"><?php echo $row['course'];?></td>
                                            <td style="vertical-align: middle;"><?php echo $row['year'];?></td>
                                            <td style="vertical-align: middle;"><?php echo $row['sem'];?></td>
                                            <td style="vertical-align: middle;"><?php echo $row['unit'];?>/<?php echo $row['credit'];?></td>
                                            <td style="vertical-align: middle;" class="text-center">
                                            <button class="update_sub btn btn-primary btn-sm btn-secondary elevation-3" 
                                            data-name="<?php echo $row['id'];?>" 
                                            data-code= "<?php echo $row['code'];?>" 
                                            data-title = "<?php echo $row['title'];?>" 
                                            data-unit = "<?php echo $row['unit'];?>"
                                            data-credits = "<?php echo $row['credit'];?>"
                                            data-toggle="modal" data-target="#updatemodal"><i class="fas fa-edit"></i></button>
                                            <button class="delete_subject btn btn-primary btn-sm btn-danger elevation-3"  data-id="<?php echo $row['id'];?>"><i class="fas fa-trash-alt"></i></button>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                    </tbody>
                                </table>
                                <div class="btn-group py-2">
                                    <button class="btn btn-sm btn-dark elevation-3" onclick="location.href='index.php'" id="button-all"><i class="fas fa-backspace"></i> Back </button>
                                </div>
                            </div>
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
                <h5 class="title"><b><i class="fas fa-edit"></i> Update Subject Information</b></h5>
            </div>
            <div class="modal-body">
                <form method="post" id="update_form" enctype='multipart/form-data' class="row">
                    <div class="col-md-12 pt-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="uptitle" id="uptitle" style="text-transform: capitalize;" required>
                    </div>
                    <div class="col-md-4 pt-3">
                        <label class="form-label">Subject Code</label>
                        <input type="tel" class="form-control" name="upsubcode" id="upsubcode" maxlength="7" required>
                    </div>
                    <div class="col-md-4 pt-3">
                        <label class="form-label">Units</label>
                        <select id="upunit" name="upunit" class="form-control select2" required>
                        <option value="" selected disabled>Select Units</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        </select>
                    </div>
                    <div class="col-md-4 pt-3">
                        <label class="form-label">Credits</label>
                        <select id="upcredit" name="upcredit" class="form-control select2" required>
                        <option value="" selected disabled>Select Credits</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        </select>
                    </div>
                    <div class="col-md-12 pt-3">
                        <button type="submit" id="button-all" class="updatesub btn btn-sm btn-dark elevation-3"><i class="fas fa-save"></i>&nbsp;Update</button>
                        <button type="submit" class="btn btn-danger float-right btn-sm elevation-3" data-dismiss="modal"><i class="fas fa-times-circle"></i></button>
                        <input type="hidden" name="sub_id" id="sub_id"/>
                        <input type="hidden" name="action" id="action"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

$(document).ready(function(){

    $('#data_table').DataTable();

    $(document).on("click", ".add_subject", function(){

        var action = "add_subj";

        var recordid = $('#recordid').val();
        var subcode = $('#subcode').val();
        var title = $('#title').val();
        var unit = $('#unit').val();
        var credits = $('#credits').val();
        var course = $('#course').val();
        var year = $('#year').val();
        var semester = $('#semester').val();

        $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action,recordid:recordid,
        subcode:subcode,title:title,
        unit:unit,course:course,year:year,
        semester:semester,credits:credits},
        success: function(data){ 
            }
        });
    });

    $(document).on("click", ".update_sub", function(){

        var sub_id = $(this).data("name");
        var upsubcode = $(this).data("code");
        var uptitle = $(this).data("title");
        var upunit = $(this).data("unit");
        var upcredit = $(this).data("credits");

        $('#sub_id').val(sub_id);
        $('#upsubcode').val(upsubcode);
        $('#uptitle').val(uptitle);
        $('#upunit').val(upunit);
        $('#upcredit').val(upcredit);
        $('#updatemodal').modal('show');
        $('#action').val("update_subject");
        $('#updatesub').val('Update');
    });

    $(document).on('click','.updatesub', function(){

        var sub_id = $('#sub_id').val();

        var upsubcode = $('#upsubcode').val();
        var uptitle = $('#uptitle').val();
        var upunit = $('#upunit').val();
        var upcredit = $('#upcredit').val();

        var action = $('#action').val();

        if(sub_id != '')
        {
        $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action,upsubcode:upsubcode, 
        uptitle:uptitle,sub_id:sub_id,
        upunit:upunit,upcredit:upcredit},
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

    $(document).on("click", ".delete_subject", function(){
            
        var subject_id = $(this).data("id");
    
        var action = "delete_subject";
    
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
            data:{action:action, subject_id:subject_id},
            success:function(data)
            {
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Delete Subject Successful!',
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