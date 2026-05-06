<?php
    include('../include/navigationheader1.php'); 
    $querycourse = mysqli_query($conn,"SELECT * FROM course ORDER BY course_name ASC");
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1><img src="../../img/course.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"> <b>Course</b> 
                            <ol class="breadcrumb float-sm-right" style="font-size:15px;">
                                <li class="breadcrumb-item"><a href="../index.php"><i class="fas fa-home"></i> Home</a></li>
                                <li class="breadcrumb-item active">Course</li>
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
                            <button type="button" class="btn float-left btn-sm"><h5 class="card-title" id="arrow-back"><i class="fas fa-plus-circle"></i> <b>Add New Course</b></h5></button> 
                            <button type="button" class="btn float-right btn-sm" data-card-widget="collapse" id="card-header"><i class="fas fa-caret-down"></i></button>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype='multipart/form-data' class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Course</label>
                                    <input type="text" class="form-control" name="course" id="course" placeholder="Course abbreviation" style="text-transform:uppercase" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Course Description</label>
                                    <input type="text" class="form-control" name="fullcourse" id="fullcourse" placeholder="Course Full Name" style="text-transform: capitalize;" required>
                                </div>
                                <div class="col-md-12 pt-2 text-right">
                                    <button type="submit" class="addcourse btn btn-sm btn-dark elevation-3" id="button-all"><i class="fas fa-plus-square"></i> Add</button>
                                    <input type="hidden" name="coursename" id="coursename"/>
                                    <input type="hidden" name="action" id="action"/>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="far fa-list-alt"></i> List of Courses</h3>
                        </div>
                        <div class="table-responsive px-2 pt-3">
                            <table id="data_table" class="table table-striped table-bordered table-sm" >
                                <thead>
                                    <th>No.</th> 
                                    <th>Course</th>
                                    <th>Course Description</th>
                                    <th class="text-center">Option</th> 
                                </thead>
                                <tbody>
                                <?php $count = 1;?>
                                <?php while($row = mysqli_fetch_array($querycourse)): ?>
                                    <tr>
                                        <td ><?php echo $count++;?></td>
                                        <td style="vertical-align: middle;"><?php echo $row['course_name'];?></td>
                                        <td style="vertical-align: middle;"><?php echo $row['full_course_name'];?></td>
                                        <td style="vertical-align: middle;" class="text-center">
                                        <button class="update_course btn btn-primary btn-sm btn-secondary elevation-3" data-id="<?php echo $row['id'];?>" data-name= "<?php echo $row['course_name'];?>" data-fcourse = "<?php echo $row['full_course_name'];?>" data-toggle="modal" data-target="#updatecourse"><i class="fas fa-edit"></i></button>
                                        <button class="delete_course btn btn-primary btn-sm btn-danger elevation-3"  data-id="<?php echo $row['id'];?>"><i class="fas fa-trash-alt"></i></button>
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
<div class="modal fade" id="updatecourse">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="header pl-3 pt-3">
                <h5 class="title"><b><i class="fas fa-edit"></i> Update Course Information</b></h5>
            </div>
            <div class="modal-body">
                <form method="post" id="update_form" enctype='multipart/form-data'>
                    <div class="form-group pt-3">
                        <label class="form-label">Course</label>
                        <input type="text" class="form-control" name="upcourse" id="upcourse" required>
                    </div>
                    <div class="form-group pt-3">
                        <label class="form-label">Full Course Name</label>
                        <input type="text" class="form-control" name="upfullcourse" id="upfullcourse" style="text-transform: capitalize;" required>
                    </div>
                    <div class="form-group pt-3">
                        <button type="submit" id="button-all" class="updatecourse btn btn-sm btn-dark elevation-3"><i class="fas fa-save"></i> Update </button>
                        <button type="submit" class="btn btn-danger btn-sm float-right elevation-3" data-dismiss="modal"><i class="fas fa-times-circle"></i></button>
                        <input type="hidden" name="course_id" id="course_id"/>
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

    $(document).on("click", ".addcourse", function(){
        
        var action = "add_course";
        var course = $('#course').val();
        var fullcourse = $('#fullcourse').val();

        $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action,course:course, fullcourse:fullcourse},
        success: function(data)
        {
        }
        });
    });

    $(document).on("click", ".update_course", function(){

        var course_id = $(this).data("id");
        var upcourse = $(this).data("name");
        var upfullcourse = $(this).data("fcourse");

        $('#course_id').val(course_id);
        $('#upcourse').val(upcourse);
        $('#upfullcourse').val(upfullcourse);
        $('#updatecourse').modal('show');
        $('#action').val("change");
    });

    $(document).on('click','.updatecourse', function(){

        var course_id = $('#course_id').val();

        var upcourse = $('#upcourse').val();
        var upfullcourse = $('#upfullcourse').val();

        var action = $('#action').val();

        if(course_id != '')
        {
        $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action,course_id:course_id, upcourse:upcourse,upfullcourse:upfullcourse},
        success:function(data)
        {
            $('#updatecourse').modal('hide');
        }
        });
        }
        else
        {
        alert("Error");
        }
    });

    $(document).on("click", ".delete_course", function(){
            
        var course_id = $(this).data("id");
    
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
            data:{action:action, course_id:course_id},
            success:function(data)
            {
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Delete Course Successful!',
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