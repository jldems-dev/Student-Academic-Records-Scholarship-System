<?php
    include "include/navigationheader.php"; 
    $query = mysqli_query($conn, "SELECT * FROM sch_files WHERE status='0' GROUP BY studid ORDER BY date");
 ?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
      <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h1><img src="../../img/schdocu.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"> Student Sent Files
                      <ol class="breadcrumb float-sm-right" style="font-size:15px;">
                          <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                          <li class="breadcrumb-item active">Student Sent Files</li>
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
              <h3 class="card-title"><i class="far fa-list-alt"></i> List of Student Sent Files</h3>
              <button type="button" class="btn btn-dark btn-sm float-right elevation-3" data-toggle="modal" data-target="#selectstudent" id="button-all" ><i class="fas fa-check-square"></i>&nbsp;&nbsp;Select Student</button>
            </div>
            <div class="table-responsive px-2 pt-3">
              <table id="data_table" class="table table-striped table-bordered table-sm" >
                  <thead>
                      <th>Full Name</th>
                      <th>Course</th>
                      <th>Year</th>
                      <th>Section</th>
                      <th>Files #</th>
                      <th>Scholarship Name</th>
                      <th>Option</th>
                  </thead>
                  <tbody>
                  <?php
                    while ($row = mysqli_fetch_assoc($query)){
                      $studinfo = mysqli_query($conn, "SELECT * FROM student WHERE id='".$row['studid']."'");
                      $rowifno=mysqli_fetch_assoc($studinfo);
                      $query1 = mysqli_query($conn, "SELECT * FROM sch_files WHERE studid='".$rowifno['id']."'");
                      $count=mysqli_num_rows($query1);
                      $rowschname=mysqli_fetch_assoc($query1);
                  ?>
                      <tr>
                        <td><?php echo $rowifno['fname'];?> <?php echo $rowifno['mname'];?>. <?php echo $rowifno['lname'];?></td>
                        <td><?php echo $rowifno['course'];?></td>
                        <td><?php echo $rowifno['year'];?> </td>
                        <td><?php echo $rowifno['section'];?></td>
                        <td><?php echo $count;?></td>
                        <td><?php echo $rowschname['sch_name'];?></td>
                        <td style="vertical-align: middle;">
                          <button type="button" class=" view_sentfiles btn btn-sm btn-primary elevation-3" data-id="<?php echo $rowifno['id'];?>"><i class="fas fa-eye"></i></button>
                          <button type="button" class=" deletestudfiles btn btn-sm btn-danger elevation-3" data-id="<?php echo $rowifno['id'];?>"><i class="fas fa-trash-alt"></i></button>
                        </td>
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
<div class="modal fade" id="selectstudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-body p-0">
          <div class="header pl-3 pt-3">
              <h5 class="title"><b>Select Student To Sent Files</b></h5>
          </div>
            <div class="table-responsive px-2 pt-3">
              <table id="data_table1" class="table table-striped table-bordered table-sm" >
                  <thead>
                      <th><input  type="checkbox" name="checkall" id="checkall" onClick="check_uncheck_checkbox(this.checked);"/></th>
                      <th>Full Name</th>
                      <th>Course</th>
                      <th>Year</th>
                      <th>Section</th>
                      <th>Status</th>
                  </thead>
                  <tbody>
                    <?php
                          while ($rowselect = mysqli_fetch_array($masterlist)) {
                      ?>
                        <tr id="<?php echo $rowselect['id'];?>">
                            <td><input type="checkbox" class="checked" name="select" value="<?php echo $rowselect['id'];?>"/></td>
                            <td><?php echo $rowselect['fname'];?></td>
                            <td><?php echo $rowselect['course'];?></td>
                            <td><?php echo $rowselect['year'];?></td>
                            <td><?php echo $rowselect['section'];?></td>
                            <td>
                                <?php 
                                $checked = mysqli_query($conn,"SELECT * FROM sch_selectstudents  WHERE studid='".$rowselect['id']."' AND status=1 ");
                                if ($check = mysqli_num_rows($checked) > 0){ echo  'Already Assign';}
                                ?>
                            </td>
                        </tr>
                  <?php
                          }
                      ?>
                      </tbody>
              </table>
            </div>
            <div class="btn-group py-2 px-2">
              <button class="assign_students btn btn-sm btn-dark elevation-3" id="button-all"><i class="fas fa-user-check"></i> Assign Student</button>
              <button class="unassign_students btn btn-sm btn-dark elevation-3" id="button-all"><i class="fas fa-times-circle"></i> Unassign Student</button>
            </div>
          </div>
        </div>
    </div>
</div>
<div class="modal fade" id="viewsentfiles" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="header pl-3 pt-3">
              <h5 class="title"><b>Sent Files Information</b></h5>
          </div>
          <div class="modal-body" id="file_list">
          </div>
      </div>
  </div>
</div>
<script type="text/javascript">

function check_uncheck_checkbox(isChecked) {
      if(isChecked) {
          $('input[name="select"]').each(function() { 
              this.checked = true; 
          });
      } else {
          $('input[name="select"]').each(function() {
              this.checked = false;
          });
      }
    }

  $('#data_table').DataTable();
  $('#data_table1').DataTable();

  $(document).on('click', '.assign_students', function(){

var id = [];

$(".checked").each(function(){
    if($(this).is(":checked")){
        id.push($(this).val())
    }
});

id = id.toString();

var action = "assign_student_sent";

    $.ajax({
    url:"action.php",
    method:"POST",
    data:{action:action,id:id},
    success:function(data)
    {
   if(data == 'success'){
        Swal.fire({
        position: 'top-center',
        title: 'Student Assigned Successful',
        icon: data,
        showConfirmButton: false,
        timer: 2000
        }).then((result) => {
          location.reload();
        });
    }else if(data == 'warning'){
      Swal.fire({
        position: 'top-center',
        title: 'Checked The Box If You Want To Assign Student!',
        icon: data,
        showConfirmButton: false,
        timer: 2000
        }).then((result) => {
          location.reload();
        });
    }
       
    var ele=document.getElementsByName('select');  
        for(var i=0; i<ele.length; i++){  
            if(ele[i].type=='checkbox')  
                ele[i].checked=false;  
        }
        var ele=document.getElementsByName('checkall');  
        for(var i=0; i<ele.length; i++){  
            if(ele[i].type=='checkbox')  
                ele[i].checked=false;  
        }
    }
    });
});

$(document).on('click', '.unassign_students', function(){

var id = [];

$(".checked").each(function(){
    if($(this).is(":checked")){
        id.push($(this).val())
    }
});

id = id.toString();

var action = "unassign_student_sent";

    $.ajax({
    url:"action.php",
    method:"POST",
    data:{action:action,id:id},
    success:function(data)
    {
     if(data == 'success'){
        Swal.fire({
        position: 'top-center',
        title: 'Student Unassigned Successful',
        icon: data,
        showConfirmButton: false,
        timer: 2000
        }).then((result) => {
          location.reload();
        });
     }
    var ele=document.getElementsByName('select');  
        for(var i=0; i<ele.length; i++){  
            if(ele[i].type=='checkbox')  
                ele[i].checked=false;  
        }
        var ele=document.getElementsByName('checkall');  
        for(var i=0; i<ele.length; i++){  
            if(ele[i].type=='checkbox')  
                ele[i].checked=false;  
        }
    }
    });
});

  $(document).on('click', '.view_sentfiles', function(){

  var stud_id = $(this).data("id");
  var action = "view_studfiles";

    $.ajax({
    url:"action.php",
    method:"POST",
    data:{action:action, stud_id:stud_id},
    success:function(data)
    {
      $('#viewsentfiles').modal('show');
      $('#file_list').html(data);
    }
    });
  });
    
  $(document).on('click', '.deletestudfiles', function(){

    var stud_id = $(this).data("id");
    var action = "delete_studfiles";
      $.ajax({
      url:"action.php",
      method:"POST",
      data:{action:action, stud_id:stud_id},
      success:function(data)
      {
      }
  });

});

</script>

