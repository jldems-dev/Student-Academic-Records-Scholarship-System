<?php
    include "include/navigationheader.php";

    $schid=$_GET['schid'];
    $schname=$_GET['schname'];
    $schsy=$_GET['schsy'];
 ?>
 <div class="content-wrapper" style="padding-top: 70px">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
			    <div class ="card" id="index-color">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                        <button type="button" onclick="history.go(-1);" class="float-left btn btn-sm"><i class="fas fa-arrow-left" id="arrow-back"></i></button>
                        <h3 class="card-title w-100"><?php echo $schname;?></h3>
                        </div>
                    </div>
			    </div>
                <div class="card">
                    <div class="card-header p-2" id="card-header1">
                    <h5 class="card-title text-left"><i class="fas fa-th-list"></i> List of Student Qualified <?php echo $schname;?> for SY <?php echo $schsy;?></h5>
                    </div>
                    <div class="card-body p-2">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="table-responsive">
                                    <table id="qualified_table" class="table table-striped table-bordered table-sm" data-tablesaw-mode="swipe">
                                        <thead>
                                            <th>No.</th>
                                            <th>Last Name</th>
                                            <th>First Name</th>
                                            <th>Middle Initials</th>
                                            <th>Course</th>
                                            <th>Year</th>
                                            <th>Section</th>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $count = 1;
                                                $schname_studlist=mysqli_query($conn,"SELECT * FROM schname_studlist WHERE schname_id='$schid'");
                                                while ($rowsnsl = mysqli_fetch_assoc($schname_studlist)){
                                                    $std = $rowsnsl['studid'];
                                                $studquali=mysqli_query($conn,"SELECT * FROM student WHERE id='$std' ORDER BY lname");
                                                 $rowstudquali=mysqli_fetch_assoc($studquali);
                                            ?>
                                            <tr>
                                                <td><?php echo $count++;?></td>
                                                <td><?php echo $rowstudquali['lname'];?> </td>
                                                <td><?php echo $rowstudquali['fname'];?></td>
                                                <td><?php echo $rowstudquali['mname'];?></td>
                                                <td><?php echo $rowstudquali['course'];?></td>
                                                <td><?php echo $rowstudquali['year'];?></td>
                                                <td><?php echo $rowstudquali['section'];?></td>
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
<script>
$('#qualified_table').DataTable({
    "bPaginate": false,
    "bLengthChange": false,
    "bInfo": false,
});
</script>
