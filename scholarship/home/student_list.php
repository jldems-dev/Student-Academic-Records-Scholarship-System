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
                      <h1><img src="../../img/facultystud.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"> Student
                      <ol class="breadcrumb float-sm-right" style="font-size:15px;">
                          <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                          <li class="breadcrumb-item active">Student</li>
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
              <h3 class="card-title"><i class="far fa-list-alt"></i> Master List of Student</h3>
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
                  </thead>
                  <tbody>
                  <?php
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($masterlist)){
                  ?>
                    <tr>
                      <td><?php echo $count++;?></td>
                      <td><?php echo $row['fname'];?></td>
                      <td><?php echo $row['mname'];?></td>
                      <td><?php echo $row['lname'];?></td>
                      <td><?php echo $row['course'];?></td>
                      <td><?php echo $row['year'];?></td>
                      <td><?php echo $row['section'];?></td>
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
<script type="text/javascript">
    $('#scholar_table').DataTable();
</script>

