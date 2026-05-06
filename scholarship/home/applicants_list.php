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
              <h2 class="card-title"><i class="far fa-list-alt"></i> List of Student Applicants</h2>
            </div>
            <div class="card-body p-0">
            <div class="table-responsive px-2 pt-3 " >
                <table id="app_table" width="2600" class="table table-striped table-bordered table-sm text-left" style='font-size:12px; table-layout: scroll;'>
                    <thead>
                        <tr>
                            <th >Student ID No.</th>
                            <th>Last Name</th>
                            <th>Given Name</th>
                            <th>Extention Name</th>
                            <th>Middle Name</th>
                            <th>Sex</th>
                            <th>Birthday</th>
                            <th>Course</th>
                            <th>Year</th>
                            <th>Fathers Name</th>
                            <th>Mothers Name</th>
                            <th>DSWD HOUSEHOLD NO.</th>
                            <th>HOUSEHOLD PER CAPITA INCOME</th>
                            <th>STREET & BARANGAY</th>
                            <th>ZIPCODE</th>
                            <th>TOTAL ASS. 1ST SEM</th>
                            <th>TOTAL ASS. 2ND SEM</th>
                            <th>DISABILITY</th>
                            <th>CCT. NO.</th>
                            <th>EMAIL</th>
                            <th>SCHOOL YEAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $stud_app=mysqli_query($conn,"SELECT * FROM sch_applctionform WHERE sch_nameid='$schnameid' ORDER BY sy ASC");
                            while($rowstud_list=mysqli_fetch_assoc($stud_app)){
                        ?>
                        <tr>
                            <td><?php echo $rowstud_list['stud_idnum'];?></td>
                            <td><?php echo $rowstud_list['last_name'];?></td>
                            <td><?php echo $rowstud_list['given_name'];?></td>
                            <td><?php echo $rowstud_list['ext_name'];?></td>
                            <td><?php echo $rowstud_list['middle_name'];?></td>
                            <td><?php echo $rowstud_list['sex'];?></td>
                            <td><?php echo $rowstud_list['bday'];?></td>
                            <td><?php echo $rowstud_list['course'];?></td>
                            <td><?php echo $rowstud_list['year_lvl'];?></td>
                            <td><?php echo $rowstud_list['f_lname'];?>, <?php echo $rowstud_list['f_gname'];?> <?php echo $rowstud_list['f_mname'];?></td>
                            <td><?php echo $rowstud_list['m_lname'];?>, <?php echo $rowstud_list['m_gname'];?> <?php echo $rowstud_list['m_mname'];?></td>
                            <td><?php echo $rowstud_list['dswd_hsno'];?></td>
                            <td><?php echo $rowstud_list['hsh_no'];?></td>
                            <td><?php echo $rowstud_list['brgy'];?></td>
                            <td><?php echo $rowstud_list['zpcode'];?></td>
                            <td><?php echo $rowstud_list['first_sem'];?></td>
                            <td><?php echo $rowstud_list['second_sem'];?></td>
                            <td><?php echo $rowstud_list['dsblty'];?></td>
                            <td><?php echo $rowstud_list['cntct_num'];?></td>
                            <td><?php echo $rowstud_list['email_add'];?></td>
                            <td><?php echo $rowstud_list['sy'];?></td>
                           
                         
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
                <div class="btn-group py-2 px-2">
                      <button class="btn btn-sm btn-dark elevation-3" onclick="history.go(-1);" id="button-all"><i class="fas fa-backspace"></i> Back </button>
                      <button type="button" onclick="location.href='export_excel.php?sch_nameid=<?php echo $schnameid;?>'" class="btn btn-sm btn-dark elevation-3" id="button-all"><i class="fas fa-file-export"></i> Export to Excel</button>
                  </div>
            </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script>
    $('#app_table').DataTable();


$(document).ready(function() {
    jQuery('#export-to-csv').bind("click", function() {
        var target = $(this).attr('id');
        switch(target) {
        case 'export-to-csv' :
        $('#hidden-type').val(target);
        $('#export-form').submit();
        $('#hidden-type').val('');
        break
        }
        });
    });
</script>