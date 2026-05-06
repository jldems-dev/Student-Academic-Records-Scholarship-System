<?php
   include "include/navigationheader.php";
   $subjectcode = $_GET['subjecode'];
   $subjectitle = $_GET['subjectitle'];
   $subjectid = $_GET['subjectid'];
   $sy = $_GET['sy'];
   $tchid = $_GET['tchid'];
   $course = $_GET['course'];
   $year = $_GET['year'];
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1><i class="fas fa-book"></i> <?php echo $subjectcode." - ".$subjectitle;?>
                            <ol class="breadcrumb float-sm-right" style="font-size:15px;">
                                <li class="breadcrumb-item"><a href="../index.php"><i class="fas fa-home"></i> Home</a></li>
                                <li class="breadcrumb-item active">My Student / <?php echo $subjectcode." - ".$subjectitle;?></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-list-alt"></i> Student List</h3>
                        </div>
                        <div class="card-body p-0 pt-2">
                            <div class="table-responsive px-2 pt-3">
                                <table id="datatable" class="table table-bordered table-sm">
                                    <thead>
                                        <th width="10px">No.</th>
                                        <th>Stud. ID#</th>
                                        <th>Full Name</th>
                                        <th>Course</th>
                                        <th>Year & Section</th>
                                        <th>Sex</th>
                                        <th>Input Grades</th>
                                    </thead>
                                    <tbody>
                                            <?php
                                            $count = 1;
                                            $studentload = mysqli_query($conn,"SELECT * FROM student_subjects WHERE subid='$subjectid' AND sy='$sy'");
                                            $check = true;
                                            while ($row1 = mysqli_fetch_array($studentload)){
                                            $check = false;

                                            $studentlist = mysqli_query($conn,"SELECT * FROM student WHERE id='".$row1['studid']."' ORDER BY lname ASC ");
                                                
                                                while($row2 = mysqli_fetch_assoc($studentlist)){

                                                ?>
                                            <tr>
                                                <td><?php echo $count++;?></td>
                                                <td><?php echo $row2['studid'];?></td>
                                                <td style="vertical-align: middle;"><?php echo $row2['lname'];?>, <?php echo $row2['fname'];?> <?php echo $row2['mname'];?>.</td>
                                                <td style="vertical-align: middle;"><?php echo $row2['course'];?></td>
                                                <td style="vertical-align: middle;"><?php echo $row2['year']; ?> - <?php echo $row2['section']; ?></td>
                                                <td style="vertical-align: middle;"><?php echo $row2['gender']; ?></td>
                                                <td width="10%"><a class="btn btn-sm btn-primary" href="calculate_grades.php?studid=<?php echo $row2['id'];?>&subid=<?php echo $row1['subid'];?>"><i class="fas fa-calculator"></i></a></td>
                                            </tr >
                                            <?php 
                                                }
                                            }
                                            ?>
                                    </tbody>
                                </table>
                                <div class="btn-group my-2">
                                    <button id="button-all" class="btn btn-sm btn-dark elevation-3" onclick="location.href='my_student.php'"><i class="fas fa-backspace"></i> Back</button>
                                    <button id="button-all" class="btn btn-sm btn-dark elevation-3 " 
                                    onclick="location.href='faculty_students.php?subjectid=<?php echo $subjectid;?>&facultyid=<?php echo $tchid;?>&subjectcode=<?php echo $subjectcode;?>&subjecttitle=<?php echo  $subjectitle;?>&subjectsy=<?php echo $sy?>&course=<?php echo $course;?>&year=<?php echo $year;?>'">All Students Grades</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<style>
.modal.modal-fullscreen .modal-dialog {
  width:100vw;
  height:100vh;
  margin:0;
  padding:0;
  max-width:none;
}
.modal.modal-fullscreen .modal-content {

  height:auto;
  height:100vh;
  border-radius:0;
  border:none;
}
.modal.modal-fullscreen .modal-body {

  overflow-y:auto;
}
</style>
<div class="modal fade modal-fullscreen" id="allspreedsheet" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content ">
          <div class="header pl-3 pt-3">
              <h5 class="title"><b>View Announcement</b></h5>
          </div>
          <div class="modal-body" id="file_list">
          </div>
          <div>
          <button type="submit" class="btn btn-danger btn-sm float-right my-2 mx-2" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>
<script>
$('#datatable').DataTable();
$(document).ready(function(){

    $(document).on('click', '.submit_general_average', function(){

    var class_id = $(this).data("classid");
    var id = [];
   
    $(".checked").each(function(){
        if($(this).is(":checked")){
            id.push($(this).val())
        }
    });

     id = id.toString();
    

    var action = "average";

        $.ajax({
        url:"my_student_action.php",
        method:"POST",
        data:{action:action,class_id:class_id,id:id},
        success:function(data)
        {
        alert(data);

        var ele=document.getElementsByName('select_stud');  
            for(var i=0; i<ele.length; i++){  
                if(ele[i].type=='checkbox')  
                    ele[i].checked=false;  
            }
        }
        });
    });
    $(document).on('click', '.viewallspreed', function(){

    var subjectid = $(this).data("id");
    var subjeccode = $(this).data("name");
    var action = "view_allspreed";

        $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action, subjectid:subjectid,subjeccode:subjeccode},
        success:function(data)
        {
            $('#allspreedsheet').modal('show');
            $('#file_list').html(data);
        }
        });
    });
});
function selects(){  
        var ele=document.getElementsByName('select_stud');  
        for(var i=0; i<ele.length; i++){  
            if(ele[i].type=='checkbox')  
                ele[i].checked=true;  
        }  
    }  
    function deSelect(){  
        var ele=document.getElementsByName('select_stud');  
        for(var i=0; i<ele.length; i++){  
            if(ele[i].type=='checkbox')  
                ele[i].checked=false;  
                
        }  
    }      
</script>