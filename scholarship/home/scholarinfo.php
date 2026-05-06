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
                      <h1><img src="../../img/schnme.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"> Scholarship Program
                      <ol class="breadcrumb float-sm-right" style="font-size:15px;">
                          <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                          <li class="breadcrumb-item active">Scholarship Information / Scholarship Program</li>
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
              <h3 class="card-title"><i class="far fa-list-alt"></i> List of Scholarship Program</h3>
              <button type="button" class="btn btn-dark btn-sm float-right elevation-3" data-toggle="modal" data-target="#addprogram" id="button-all"><i class="fas fa-plus-square" ></i>&nbsp;&nbsp;Scholarship Program</button>
            </div>
            <div class="table-responsive px-2 pt-3">
              <table id="scholar_table" class="table table-striped table-bordered table-sm" >
                  <thead>
                      <th width="8%">No.</th>
                      <th>Title</th>
                      <th width="8%">Option</th>
                  </thead>
                  <tbody>
                  <?php
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($schprogram)){
                  ?>
                    <tr>
                      <td style="vertical-align: middle;"><?php echo $count++;?></td>
                      <td><?php echo $row['title'];?></td>
                      <td style="vertical-align: middle;">
                        <a  class="btn btn-sm btn-success elevation-3" href="scholarproglist.php?progid=<?php echo $row['id'];?>&progname=<?php echo $row['title']?>"><i class="fas fa-arrow-circle-right"></i></a>
                        <button  class="delete_program btn btn-sm btn-danger elevation-3" id="<?php echo $row['id'];?>"><i class="fas fa-trash-alt"></i></button>
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
  </section>
</div>
<div class="modal fade" id="addprogram" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form method="post" id="upload_form" enctype='multipart/form-data'>
                    <div class="form-group">
                        <label class="form-label">Add Scholarship Program</label>
                        <input type="text" class="form-control mt-2" name="title" id="title" placeholder="Enter Scholarship Title Program" style="text-transform: capitalize;" required>
                    </div>
                    <div class="col-md-12 pt-3">
                    <button type="submit" class="addprogram btn btn-dark btn-sm elevation-3" id="button-all"><i class="fas fa-plus-square"></i> Add</button>
                    <button type="submit" class="btn btn-danger btn-sm float-right elevation-3" data-dismiss="modal"><i class="fas fa-times-circle"></i></button>
                    <input type="hidden" name="action" id="action"/>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){

    $('#scholar_table').DataTable();

  $(document).on("click", ".addprogram", function(){

    var action = "add_program";
    var title = $('#title').val();

    $.ajax({
    url:"action.php",
    method:"POST",
    data:{action:action,title:title},
    success: function(data){
    }
    });
  });

  $(document).on("click", ".delete_program", function(){
            
    var program_id = $(this).attr("id");

    var action = "delete";

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
        data:{action:action, program_id:program_id},
        success:function(data)
        {
          Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Delete Scolarship Program Successfully',
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
});
</script>

