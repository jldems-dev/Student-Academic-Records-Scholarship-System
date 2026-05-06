<?php
include "../../config.php";

    $facultyid = $_POST['facultyid'];
    $subid = $_POST['subid'];
    $sy = $_POST['sy'];

    $classQ = mysqli_query($conn, "SELECT * FROM teacher WHERE id='$facultyid'");
    $row = mysqli_fetch_assoc($classQ);
?>
<div class="container-fluid" >
    <div class="col-12">
        <div class="header">
            <h3><span class="glyphicon glyphicon-user"></span><i class="fas fa-info-circle"></i> Faculty Information</h3>
        </div>
            <hr>
        <div class="left-section pt-3">
            <p>
            <b>Teacher ID :</b> <?php echo $row['teachid'];?><br/>
            <b>Full Name :</b> <?php echo $row['fname'];?> <?php echo $row['mname'];?>. <?php echo $row['lname'];?><br/>
            <b>Status :</b> <?php echo $row['status'];?>
            </p>
        </div>
            <hr>
        <div class="header">
            <h3><span class="glyphicon glyphicon-user"></span><i class="fas fa-th-list"></i> List of Enroll Student</h3>
        </div>
        <div class="table-responsive pt-3">
            <table id="table" class="table table-striped table-bordered table-sm" >
                <thead>
                    <th>No.</th> 
                    <th>Student ID</th>
                    <th>Full Name</th>
                    <th>Course</th>
                    <th>Year & Section</th>
                    <th>Sex</th>
                </thead>
                <tbody>
                    <?php 
                        $count = 1;
                        $subjects = mysqli_query($conn, "SELECT * FROM student_subjects WHERE subid='$subid' AND sy='$sy'");
                        while($row = mysqli_fetch_assoc($subjects)){

                        $studentinfo = mysqli_query($conn, "SELECT * FROM student WHERE id='".$row['studid']."'");

                        while ($row1 = mysqli_fetch_assoc($studentinfo)){
                    
                     ?>
                            <tr>
                                <td><?php echo $count++;?></td>
                                <td><?php echo $row1['studid'];?></td>
                                <td><?php echo $row1['lname'];?>, <?php echo $row1['mname'];?>. <?php echo $row1['fname'];?></td>
                                <td><?php echo $row1['course'];?></td>
                                <td><?php echo $row1['year'];?><?php echo $row1['section'];?></td>
                                <td><?php echo $row1['gender'];?></td>
                            </tr>
                        <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="btn-group py-2">
            <a class="btn btn-dark btn-sm elevation-3" data-dismiss="modal" id="button-all"><i class="fas fa-backspace"></i> Back</a>
        </div>
    </div>
</div>
<script>
    $('#table').DataTable();
</script>