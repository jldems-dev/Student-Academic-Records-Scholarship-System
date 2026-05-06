<?php
    include "include/navigationheader.php";
    $schnameid = $_GET['schnameid'];

    $schinformation = mysqli_query($conn,"SELECT * FROM sch_name WHERE id='$schnameid'");
    $rowschi = mysqli_fetch_assoc($schinformation);
 ?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
      <div class="col-12">
          <div class="card">
            <div class="card-header">
                <h1><?php echo $rowschi['name'];?>
                <ol class="breadcrumb float-sm-right" style="font-size:15px;">
                    <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="breadcrumb-item active"><?php echo $rowschi['name'];?></li>
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
              <h3 class="card-title"><i class="far fa-list-alt"></i> List of Student Qualified <?php echo $rowschi['name'];?></h3>
              <button type="button" class="btn btn-dark btn-sm float-right elevation-3" data-toggle="modal" data-target="#selectstudent" id="button-all" ><i class="fas fa-check-square"></i>&nbsp;&nbsp;Select Student</button>
            </div>
            <div class="table-responsive px-2 pt-3">
              <table id="scholar_table" class="table table-striped table-bordered table-sm" >
                  <thead>
                      <th width="8%">No.</th>
                      <th>First Name</th>
                      <th>Middle Initials</th>
                      <th>Last Name</th>
                      <th>Course</th>
                      <th>Year</th>
                      <th>Section</th>
                      <th><input  type="checkbox" name="checkall1" id="checkall1" onClick="check_uncheck_checkbox1(this.checked);"/></th>
                  </thead>
                  <tbody>
                  <?php
                    $count = 1;
                    $schname_studlist=mysqli_query($conn,"SELECT * FROM schname_studlist WHERE schname_id='$schnameid'");
                    while ($rowsnsl = mysqli_fetch_assoc($schname_studlist)){
                      $studin=mysqli_fetch_assoc($masterlist);
                  ?>
                    <tr id="<?php echo $rowsnsl['id'];?>">
                      <td><?php echo $count++;?></td>
                      <td><?php echo $studin['fname'];?></td>
                      <td><?php echo $studin['mname'];?></td>
                      <td><?php echo $studin['lname'];?></td>
                      <td><?php echo $studin['course'];?></td>
                      <td><?php echo $studin['year'];?></td>
                      <td><?php echo $studin['section'];?></td>
                      <td><input type="checkbox" class="checked" name="select1" value="<?php echo $rowsnsl['id'];?>"/></td>
                    </tr>
                  <?php
                      }
                  ?>
                  </tbody>
              </table>
              <div class="btn-group py-2">
              <button class="btn btn-sm btn-dark elevation-3" onclick="window.history.go(-1); return false;" id="button-all"><i class="fas fa-backspace"></i> Back </button>
              <button class="d_studschname btn btn-sm btn-dark elevation-3" id="button-all"><i class="fas fa-trash-alt"></i> Delete </button>
              </div>
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
              <h5 class="title"><b>Select Student</b></h5>
          </div>
            <div class="table-responsive px-2 pt-3">
              <table id="scholar1_table" class="table table-striped table-bordered table-sm" >
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
                      $list = mysqli_query($conn, "SELECT * FROM student");
                        while ($rowselect = mysqli_fetch_assoc($list)){
                      ?>
                        <tr id="<?php echo $rowselect['id'];?>">
                            <td><input type="checkbox" class="checked" name="select" value="<?php echo $rowselect['id'];?>"/></td>
                            <td><?php echo $rowselect['fname'];?></td>
                            <td><?php echo $rowselect['course'];?></td>
                            <td><?php echo $rowselect['year'];?></td>
                            <td><?php echo $rowselect['section'];?></td>
                            <td>
                                <?php 
                                $checked = mysqli_query($conn,"SELECT * FROM schname_studlist  WHERE studid='".$rowselect['id']."' AND status=1 ");
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
              <button class="assign_students btn btn-sm btn-dark" id="button-all" data-id="<?php echo $schnameid;?>" data-name="<?php echo $rowschi['scholarprogram_id'];?>"><i class="fas fa-user-check"></i> Assign Student</button>
            </div>
          </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#scholar_table').DataTable();
    $('#scholar1_table').DataTable();

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

    function check_uncheck_checkbox1(isChecked) {
      if(isChecked) {
          $('input[name="select1"]').each(function() { 
              this.checked = true; 
          });
      } else {
          $('input[name="select1"]').each(function() {
              this.checked = false;
          });
      }
    }

$(document).on('click', '.assign_students', function(){

    var schname_id = $(this).data("id");
    var schprog_id = $(this).data("name");
    var id = [];

    $(".checked").each(function(){
        if($(this).is(":checked")){
            id.push($(this).val())
        }
    });

    id = id.toString();

    var action = "assign_student_sch";



    $.ajax({
    url:"action.php",
    method:"POST",
    data:{action:action,id:id,
    schname_id:schname_id,schprog_id:schprog_id},
    success:function(data)
    {
    location.reload(true);
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

$(document).on('click', '.d_studschname', function(){

  var id = [];

  $(".checked").each(function(){
      if($(this).is(":checked")){
          id.push($(this).val())
      }
  });

  id = id.toString();

  var action = "delete_schname_stud";

  $.ajax({
  url:"action.php",
  method:"POST",
  data:{action:action,id:id},
  success:function(data)
  {
    location.reload(true);
  var ele=document.getElementsByName('select1');  
      for(var i=0; i<ele.length; i++){  
          if(ele[i].type=='checkbox')  
              ele[i].checked=false;  
      }
      var ele=document.getElementsByName('checkall1');  
      for(var i=0; i<ele.length; i++){  
          if(ele[i].type=='checkbox')  
              ele[i].checked=false;  
      }
  }
  });
});
</script>

