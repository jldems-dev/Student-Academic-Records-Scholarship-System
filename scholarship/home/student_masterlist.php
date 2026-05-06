<?php
    include "include/navigationheader.php"; 

    $query = mysqli_query($conn, "SELECT * FROM scholarprogram");
 ?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
      <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h1><i class="fas fa-home"></i> Scholarship Program
                      <ol class="breadcrumb float-sm-right" style="font-size:15px;">
                          <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                          <li class="breadcrumb-item active">Scholarship Info / Scholarship Program</li>
                      </ol>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-home"></i> Scholarship Program</h3>
              <button type="button" class="add_program btn btn-secondary btn-sm float-right" data-toggle="modal" data-target="#addprogram"><i class="fas fa-plus-square"></i>&nbsp;&nbsp;Scholarship Program</button>
            </div>
            <div class="table-responsive px-2 pt-3">
              <table id="scholar_table" class="table table-striped table-bordered table-sm" >
                  <thead>
                      <th width="8%">No.</th>
                      <th>Scholarship Title Program</th>
                      <th width="8%">Option</th>
                  </thead>
                  <?php
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($query)){
                  ?>
                  <tbody>
                      <tr>
                        <td style="vertical-align: middle;"><?php echo $count++;?></td>
                        <td><?php echo $row['title'];?></td>
                        <td style="vertical-align: middle;">
                          <a  class="btn btn-sm btn-success" href="scholarproglist.php?progid=<?php echo $row['id'];?>&progname=<?php echo $row['title']?>"><i class="fas fa-arrow-circle-right"></i></a>
                          <button  class="delete_program btn btn-sm btn-danger" id="<?php echo $row['id'];?>"><i class="fas fa-trash-alt"></i></button>
                        </td>
                      </tr>
                  </tbody>
                  <?php
                      }
                  ?>
              </table>
          </div>
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
                        <label class="form-label">Scholarship Program Title</label>
                        <input type="text" class="form-control mt-2" name="title" id="title" placeholder="Sample: Academic Scholarship Programs" style="text-transform: capitalize;" required>
                    </div>
                    <div class="col-md-6 pt-3">
                    <button type="submit" class="btn btn-secondary btn-sm" >Add</button>
                    <input type="hidden" name="action" id="action"/>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){

    $('#scholar_table').DataTable();

  $(document).on("click", ".add_program", function(){

    var title = $(this).attr("id");

    $('#title').val(title);
    $('#action').val("add");
    $('#addprogram').modal('show');

  });
  $('#upload_form').on('submit', function(){

    var action = $('#action').val();
    var title = $('#title').val();

    $.ajax({
    url:"action.php",
    method:"POST",
    data:{action:action,title:title},
    success: function(data)
    { 
    alert(data);
    }
    });

  });
  $(document).on("click", ".delete_program", function(){
            
    var program_id = $(this).attr("id");

    var action = "delete";

    if(confirm("Are you sure you want to delete Scholarship Program?"))
        {
        $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action, program_id:program_id},
        success:function(data)
        {
        location.reload(true);
        }
        });
        }
  });
});
</script>

