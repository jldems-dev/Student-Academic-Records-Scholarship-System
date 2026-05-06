<?php

    include('../include/navigationheader1.php'); 

        $student_id = $_GET['studid'];
        $recordid = $_GET['recordid'];
        $sem = $_GET['sem'];
        $sy = $_GET['sy'];
        $std_year = $_GET['year'];

        $studentinfo = mysqli_query($conn, "SELECT * FROM student WHERE id='$student_id'");
        $rowinfo = mysqli_fetch_assoc($studentinfo);
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1><i class="fas fa-clipboard-list"></i> <b>Subject List of Student</b>
                            <ol class="breadcrumb float-sm-right" style="font-size:15px;">
                                <li class="breadcrumb-item"><a href="../index.php"><i class="fas fa-home"></i> Home</a></li>
                                <li class="breadcrumb-item active">Record of Student</li> <li class="breadcrumb-item active">Subject List of Student</li>
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
                            <h3 class="card-title"><i class="far fa-list-alt"></i> Subject List</h3>
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
                            <table class="table table-striped table-bordered table-sm">
                                <thead>
                                    <th>Subject Code</th>
                                    <th>Subject Title</th>
                                    <th>Units</th>
                                    <th>Prelim</th>
                                    <th>Midterm</th>
                                    <th>Prefinal</th>
                                    <th>Final</th>
                                    <th>Average</th>
                                    <th>Equivalent</th>
                                    <th>Remarks</th>
                                    <th>Unenroll</th>
                                </thead>
                                <?php
                                    $count=1;
                                    $studentsubjects = mysqli_query($conn,"SELECT * FROM student_subjects WHERE studid='$student_id' AND sem='$sem' AND sy='$sy'");
                                    $check = true;
                                    while ($row = mysqli_fetch_assoc($studentsubjects)){
                                        $check = false;
                                        $subjects = mysqli_query($conn,"SELECT * FROM subject WHERE id='".$row['subid']."'");
                                        while($row1 = mysqli_fetch_assoc($subjects)){
                                            
                                            $prelim = mysqli_query($conn,"SELECT * FROM student_prelim WHERE studid='$student_id' AND subid='".$row['subid']."'");
                                            $rowprelim=mysqli_fetch_assoc($prelim);
                                            $midterm = mysqli_query($conn,"SELECT * FROM student_midterm WHERE studid='$student_id' AND subid='".$row['subid']."'");
                                            $rowmidterm=mysqli_fetch_assoc($midterm);
                                            $prefinal = mysqli_query($conn,"SELECT * FROM student_prefinal WHERE studid='$student_id' AND subid='".$row['subid']."'");
                                            $rowprefinal=mysqli_fetch_assoc($prefinal);
                                            $final = mysqli_query($conn,"SELECT * FROM student_final WHERE studid='$student_id' AND subid='".$row['subid']."'");
                                            $rowfinal=mysqli_fetch_assoc($final);
                                ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $row1['code'];?></td>
                                        <td><?php echo $row1['title'];?></td>
                                        <td><?php echo $row1['unit'];?></td>
                                        <td style="background-color: yellow;"><?php echo $rowprelim['average'];?></td>
                                        <td style="background-color: yellow;"><?php echo $rowmidterm['average'];?></td>
                                        <td style="background-color: yellow;"><?php echo $rowprefinal['average'];?></td>
                                        <td style="background-color: yellow;"><?php echo $rowfinal['average'];?></td>
                                        <td style="background-color: green;">
                                            <?php
                                                $average =  $rowprelim['average']+ 
                                                            $rowfinal['average']+
                                                            $rowmidterm['average']+
                                                            $rowfinal['average'];
                                                $average = $average / 4;
                                                echo $average;
                                            ?>
                                        </td>
                                        <td style="background-color: green;">
                                            <?php
                                            $average = round($average);
                                            include "gradesheet.php";
                                            ?>
                                        </td >
                                        <td style="background-color: green;"><?php if ($average > 74){ echo  'Passed'; }else if($average == 0){echo 'None';}else if($average < 74){  echo  'Failed'; }?></td>
                                        <td width="10px"><button class="delete_subject btn btn-primary btn-sm btn-danger elevation-3"  data-id="<?php echo $row1['id'];?>" data-studid="<?php echo $student_id;?>"><i class="fas fa-trash-alt"></i></button></td>
                                    </tr>
                                </tbody>
                                <?php
                                        }
                                    }if($check){
                                        echo "<tr>
                                        <td colspan='10' class ='text-center'>No Subjects Found</td>
                                        </tr> 
                                        ";
                                    }
                                ?>
                            </table>
                            <div class="btn-group py-2">
                                <button class="btn btn-sm btn-dark elevation-3" onclick="history.go(-1);" id="button-all"><i class="fas fa-backspace"></i> Back </button>
                                <a type="submit" href="student_grades.php?id=<?php echo $student_id; ?>&stdid=<?php echo $rowinfo['studid'];?>&name=<?php echo $rowinfo['fname'];?> <?php echo $rowinfo['mname'];?>. <?php echo $rowinfo['lname'];?>&course=<?php echo $rowinfo['course'];?>&year=<?php echo $rowinfo['year'];?>&gender=<?php echo $rowinfo['gender'];?>&section=<?php echo $rowinfo['section'];?>&sem=<?php echo $sem;?>&sy=<?php echo $sy;?>&recordid=<?php echo $recordid;?>" class="assstudent btn btn-dark btn-sm elevation-3" id="button-all">
                                <i class="fas fa-eye"></i> Final Grades</a>
                                <a class="add_subjects btn btn-dark btn-sm elevation-3" 
                                data-id="<?php echo $student_id; ?>" 
                                data-sy="<?php echo $sy; ?>" 
                                data-sem="<?php echo $sem; ?>"
                                data-course="<?php echo  $rowinfo['course']; ?>"
                                data-year="<?php echo  $std_year; ?>"
                                data-recordid="<?php echo  $recordid; ?>" id="button-all">
                                <span class="glyphicon glyphicon-plus-sign"></span>  <i class="fas fa-plus-square"></i> Subjects</a>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="addsubjects" role="dialog">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
        <div class="modal-body" id="file_list">
        <button type="button" class="btn btn-danger elevation-3" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).on('click', '.add_subjects', function(){

        var id = $(this).data("id");
        var sy = $(this).data("sy");
        var sem = $(this).data("sem");
        var course = $(this).data("course");
        var year = $(this).data("year");
        var recordid = $(this).data("recordid");

        $.ajax({
        url:"assign_subjects.php",
        method:"POST",
        data:{id:id,sy:sy,sem:sem,
        course:course,year:year,recordid:recordid},
        success:function(data)
        {
            $('#file_list').html(data);
            $('#addsubjects').modal('show');
        }
        });
    });

    $(document).on("click", ".delete_subject", function(){
            
        var subjectid = $(this).data("id");
        var studid = $(this).data("studid");
    
        var action = "deletesubject";
    
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
            data:{action:action, subjectid:subjectid,studid:studid},
            success:function(data)
            {
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Delete Subject of Student Successful!',
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
</script>