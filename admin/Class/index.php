<?php
    include('../include/navigationheader1.php'); 
    $classQ = mysqli_query($conn,"SELECT * FROM class");
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1><img src="../../img/class.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"><b> Class</b>
                            <ol class="breadcrumb float-sm-right" style="font-size:15px;">
                                <li class="breadcrumb-item"><a href="../index.php"><i class="fas fa-home"></i> Home</a></li>
                                <li class="breadcrumb-item active">Class</li>
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
                            <h3 class="card-title"><i class="far fa-list-alt"></i> List of Class</h3>
                        </div>
                        <div class="table-responsive px-2 pt-3">
                            <table id="data_table" class="table table-striped table-bordered table-sm" >
                                <thead>
                                    <th>No.</th> 
                                    <th>Subject Code</th>
                                    <th>Subject title</th>
                                    <th>Units</th>
                                    <th>Faculty Name</th>
                                    <th>Schedule</th>
                                    <th>Time</th>
                                    <th>School Year</th>
                                    <th>Student</th>
                                </thead>
                                <tbody>
                                <?php
                                    $count = 1;
                                    while($row = mysqli_fetch_assoc($classQ)){
                                        $subject = mysqli_query($conn,"SELECT * FROM subject WHERE id='".$row['subid']."'");
                                            while($rowsub = mysqli_fetch_assoc($subject)){
                                                 $teachername = mysqli_query($conn, "SELECT * FROM teacher WHERE id='".$row['teachid']."'");
                                                    while($rowteach = mysqli_fetch_assoc($teachername)){
                                ?>
                                    <tr>
                                        <td ><?php echo $count++;?></td>
                                        <td style="vertical-align: middle;"><?php echo $rowsub['code']?></td>
                                        <td style="vertical-align: middle;"><?php echo $rowsub['title']?></td>
                                        <td style="vertical-align: middle;"><?php echo $rowsub['unit'];?></td>
                                        <td style="vertical-align: middle;"><?php echo $rowteach['fname'];?> <?php echo $rowteach['mname'];?>. <?php echo $rowteach['lname'];?></td>
                                        <td id="classb" contenteditable="true" class="update" data-id="<?php echo $rowsub['code'];?>" name="schedule"><?php echo $row['schedule'];?></td>
                                        <td id="classb" contenteditable="true" class="update" data-id="<?php echo $rowsub['code'];?>" name="time"><?php echo $row['time'];?></td>
                                        <td><?php echo $row['sy'];?></td>
                                        <td style="vertical-align: middle;">
                                        <button class="view_stud btn btn-sm btn-primary elevation-3" data-id="<?php echo $rowsub['id'];?>" data-name="<?php echo $rowteach['id'];?>" data-sy="<?php echo $row['sy'];?>" data-toggle="modal" data-target="#addstudent"><i class="fas fa-th-list"></i></button>
                                        </td>
                                    </tr>
                                <?php 
                                             }
                                        }
                                    }
                                ?>
                                </tbody>
                            </table>
                            <div class="btn-group py-2">
                            <button class="btn btn-sm btn-dark elevation-3" onclick="location.href='grade_sheets.php'" id="button-all"><i class="fas fa-edit"></i> Edit Grade Sheets </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="addstudent" role="dialog">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
        <div class="modal-body" id="file_list">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>
<script type="text/javascript">

$(document).ready(function(){

    $('#data_table').DataTable();

    $(document).on('click', '.view_stud', function(){

        var subid = $(this).data("id");
        var facultyid = $(this).data("name");
        var sy = $(this).data("sy");
        

        $.ajax({
        url:"student_view.php",
        method:"POST",
        data:{subid:subid, facultyid:facultyid,sy:sy},
        success:function(data)
        {
            $('#file_list').html(data);
            $('#addstudent').modal('show');
        }
        });
    });

    $(document).on('blur', '.update', function(){

        var id = $(this).data("id");
        var name = $(this).attr("name");
        var value = $(this).text();

        var action = "edit_class";

        $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action,value:value,id:id,name:name},
        success:function(data)
        {
            toastr.success(data);
        }
        });
    });
});
</script>