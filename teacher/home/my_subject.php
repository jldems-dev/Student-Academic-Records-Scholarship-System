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
                            <h1> <img src="../../img/facultysub.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"> My Subject
                            <ol class="breadcrumb float-sm-right" style="font-size:15px;">
                                <li class="breadcrumb-item"><a href="../index.php"><i class="fas fa-home"></i> Home</a></li>
                                <li class="breadcrumb-item active">My Subject</li>
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
                            <h3 class="card-title"><i class="fas fa-list-alt"></i> Subject List</h3>
                        </div>
                        <div class="table-responsive px-2 pt-3">
                            <table id="first_table" class="table table-striped table-bordered table-sm" >
                                <thead>
                                    <th>No.</th> 
                                    <th>Subject Code</th>
                                    <th>Subject title</th>
                                    <th>Course</th>
                                    <th>Units</th>
                                    <th>Semester</th>
                                    <th>Schedule</th>
                                    <th>Time</th>
                                    <th>SY</th>
                                    <th>Total Students</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    $teach_classload = mysqli_query($conn, "SELECT * FROM class WHERE teachid = '$newid'");
                                    while($row1 = mysqli_fetch_array($teach_classload)){
                                        $subject = mysqli_query($conn,"SELECT * FROM student_subjects WHERE subid='".$row1['subid']."' AND sy='".$row1['sy']."'");
                                        $rowcount=mysqli_num_rows($subject);
                                        $subjectinfo = mysqli_query($conn,"SELECT * FROM subject WHERE id='".$row1['subid']."'");
                                        $rowinfo=mysqli_fetch_assoc($subjectinfo);
                                    ?>
                                        <tr>
                                            <td><?php echo $count++;?></td>
                                            <td><?php echo $rowinfo['code'];?></td>
                                            <td><?php echo $rowinfo['title'];?></td>
                                            <td><?php echo $rowinfo['course'];?></td>
                                            <td><?php echo $rowinfo['unit'];?></td>
                                            <td><?php echo $rowinfo['sem'];?></td>
                                            <td class="bg-success"><?php echo $row1['schedule'];?></td>
                                            <td class="bg-success"><?php echo $row1['time'];?></td>
                                            <td class="bg-success"><?php echo $row1['sy'];?></td>
                                            <td><?php echo $rowcount;?></td>
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
<script>
    $('#first_table').DataTable();

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

</script>