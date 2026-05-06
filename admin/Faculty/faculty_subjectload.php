<?php
    include "../include/navigationheader1.php"; 

    $facultyid = $_GET['facultyid'];
    $facultyinfo = mysqli_query($conn,"SELECT * FROM teacher WHERE id='$facultyid'");
    $rowinfo = mysqli_fetch_assoc($facultyinfo);
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1><i class="fas fa-book-open"></i> <b>Subject Load </b> 
                            <ol class="breadcrumb float-sm-right" style="font-size:15px;">
                                <li class="breadcrumb-item"><a href="../index.php"><i class="fas fa-home"></i> Home</a></li>
                                <li class="breadcrumb-item active">Faculty</li>
                                <li class="breadcrumb-item active">Subject Load</li>
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
                            <h3 class="card-title"><i class="far fa-list-alt"></i> Subjects List of Faculty</h3>
                        </div>
                        <div class="pt-3 ml-2">
                            <p>
                                <b>Faculty ID#: </b>&emsp;&ensp;<?php echo $rowinfo['teachid'];?><br>
                                <b>Faculty Name: </b>&ensp;<?php echo $rowinfo['fname'];?> <?php echo $rowinfo['mname'];?>. <?php echo $rowinfo['lname'];?><br>
                                <b>Department: </b>&emsp;&nbsp;<?php echo $rowinfo['department'];?><br>
                                <b>Sex: </b>&emsp;&emsp;&emsp;&emsp;&emsp;<?php echo $rowinfo['gender'];?>
                            </p>
                        </div>
                        <div class="table-responsive px-2 pt-3">
                            <table id="data_table" class="table table-striped table-bordered table-sm" >
                                <thead>
                                    <th>No.</th> 
                                    <th>Subject Code</th>
                                    <th>Subject Title</th>
                                    <th>Course</th>
                                    <th>Year</th>
                                    <th>Units</th>
                                    <th>SY</th>
                                    <th>Student Grade Sheets</th>
                                    <th class="text-center">Delete</th> 
                                </thead>
                                <?php
                                    $count=1;

                                    $facultysubjects = mysqli_query($conn, "SELECT * FROM class WHERE teachid='$facultyid'");
                                    $check = true;
                                    
                                    while($rowfacsub = mysqli_fetch_assoc($facultysubjects)){
                                        
                                        $subjects = mysqli_query($conn,"SELECT * FROM subject WHERE id='".$rowfacsub['subid']."'");
                                        while($subjectrow = mysqli_fetch_assoc($subjects)){
                                            $check = false;
                                ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $count++;?></td>
                                        <td><?php echo $rowfacsub['sub_code'];?></td>
                                        <td><?php echo $subjectrow['title'];?></td>
                                        <td><?php echo $subjectrow['course'];?></td>
                                        <td><?php echo $subjectrow['year'];?></td>
                                        <td><?php echo $subjectrow['unit'];?></td>
                                        <td>
                                        <select id="sy" data-name="<?php echo $rowfacsub['id']; ?>" class="form-control">
                                        <option value="" selected disabled><?php echo $rowfacsub['sy'];?></option>
                                        <?php
                                            for( $y = 2000; $y <= 2100; $y++ ) {
                                                ?>
                                                    <option value="<?php echo $y-1; ?>-<?php echo $y; ?>"><?php echo $y-1; ?>-<?php echo $y; ?></option>
                                                <?php
                                            }
                                        ?>
                                        </select>
                                        </td>
                                        <td width="15%"><a class="view_student btn btn-primary btn-sm btn-primary elevation-3" href="faculty_students.php?subjectid=<?php echo $subjectrow['id'];?>&facultyid=<?php echo $rowinfo['id'];?>&subjectcode=<?php echo $subjectrow['code'];?>&subjecttitle=<?php echo $subjectrow['title'];?>&subjectsy=<?php echo $rowfacsub['sy']?>"><i class="fas fa-eye"></i></a></td>
                                        <td width="1%">
                                            <button class="delete_teachsub btn btn-primary btn-sm btn-danger elevation-3"  data-id="<?php echo $subjectrow['id'];?>" data-faid="<?php echo $facultyid;?>"><i class="fas fa-trash-alt"></i></button>
                                        </td>
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
                                <a class="btn btn-dark btn-sm elevation-3" href="assign_subjects.php?facultyid=<?php echo $rowinfo['id'];?>" id="button-all">
                               <i class="fas fa-plus-square"></i> Add Subjects</a>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">

$(document).ready(function(){

    $(document).on("click", ".delete_teachsub", function(){
            
        var subjectid = $(this).data("id");
        var facultyid = $(this).data("faid");
    
        var action = "delete_faculty_subject";
    
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
            data:{action:action, facultyid:facultyid,subjectid:subjectid},
            success:function(data)
            {
                Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Delete Subject Successful',
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
    $('body').on('change','#sy', function() {

        var classid = $(this).data("name");
        var value = $(this).val();
        var value_id = 'id='+ value;

        $.ajax({
            type: "POST",
            url: "selectsy.php",
            data: {value:value, classid:classid},
            success: function(data)
            {
                toastr.success(data);
            } 
            });

    });
});
</script>
