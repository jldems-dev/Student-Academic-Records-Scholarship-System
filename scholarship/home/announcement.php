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
                      <h1><img src="../../img/sdannounce.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"> Announcement
                      <ol class="breadcrumb float-sm-right" style="font-size:15px;">
                          <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                          <li class="breadcrumb-item active">Scholarship Information / Announcement</li>
                      </ol>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card collapsed-card">
            <div class="card-header " id="card-header">
                <button type="button" class="btn float-left btn-sm"><h5 class="card-title" id="text-navbar"><i class="fas fa-plus-circle"></i> <b>Add New Announcement</b></h5></button> 
                <button type="button" class="btn float-right btn-sm" data-card-widget="collapse" id="arrow-back"><i class="fas fa-caret-down"></i></button>
            </div>
            <div class="card-body">
              <p id="msg" class="text-danger"></p>
              <form method="post" id="upload_form" enctype='multipart/form-data' class="row">
                  <div class="col-md-6 pt-3">
                      <label class="form-label">Title</label>
                      <input type="text" class="form-control" name="title" id="title" maxlength="50" style="text-transform: capitalize;" required>
                  </div>
                  <div class="col-md-12 pt-3">
                    <label for="inputMessage">Message</label>
                    <textarea class="form-control" rows="6" name="message" id="message" maxlength="1999" required></textarea>
                  </div>
                  <div class="col-md-6 pt-3">
                      <label class="form-label">Link</label>
                      <input type="text" class="form-control" name="link" id="link" maxlength="1999" required>
                  </div>
                  <div class="col-md-12 pt-3 text-right">
                      <button type="submit" class="addancmt btn btn-sm btn-dark elevation-3" id="button-all"><i class="fas fa-plus-square"></i> Add</button>
                      <input type="hidden" name="action" id="action"/>
                  </div>
                </form>
              </div>
            </div>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><i class="far fa-list-alt"></i> List of Announcement</h3>
            </div>
            <div class="table-responsive px-2 pt-3">
              <table id="data_table" class="table table-striped table-bordered table-sm" >
                  <thead>
                      <th>Date</th>
                      <th>Title</th>
                      <th>Picture</th>
                      <th>Option</th>
                  </thead>
                  <tbody>
                  <?php
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($announcement)){

                      $images=mysqli_query($conn,"SELECT * FROM sch_ancmtimg WHERE ancmt_id='".$row['id']."'");
                      $rowimages=mysqli_fetch_assoc($images);
                  ?>
                      <tr>
                        <td><?php echo $row['date'];?></td>
                        <td><?php echo $row['title'];?></td>
                        <td><button type="button" class="add_ancmtimages btn btn-sm btn-primary elevation-3" data-id="<?php echo $row['id'];?>" ><i class="fas fa-plus-square"></i></button></td>
                        <td>
                          <button  class="view_ancmt btn btn-sm btn-primary elevation-3" data-id="<?php echo $row['id'];?>"><i class="fas fa-eye"></i></button>
                           <input type="hidden" name="action" id="action" />
                          <button  class="delete_ancmt btn btn-sm btn-danger elevation-3" data-id="<?php echo $row['id'];?>"><i class="fas fa-trash-alt"></i></button>
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
<div class="modal fade" id="addancmtimages" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="header pl-3 pt-3">
                <h5 class="title"><b>Upload Images Announcement</b></h5>
            </div>
            <div class="modal-body">
                <form method="post" id="upload_images" enctype='multipart/form-data'>
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" name="files[]" multiple>
                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <div class="col-md-12 pt-3">
                            <button type="submit" class="btn btn-sm btn-dark elevation-3" id="button-all"><i class="fas fa-upload"></i> UPLOAD</button>
                            <button type="submit" class="btn btn-danger btn-sm float-right elevation-3" data-dismiss="modal">Close</button>
                            <input type="hidden" name="ancmtid" id="ancmtid"/>
                        </div>
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="viewancmt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content ">
          <div class="header pl-3 pt-3">
              <h5 class="title"><b>Announcement View</b></h5>
          </div>
          <div class="modal-body" id="file_list">
          </div>
          <div>
          <button type="submit" class="btn btn-danger btn-sm float-right my-2 mx-2 elevation-3" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>
<script type="text/javascript">

$(document).ready(function(){

    $('#data_table').DataTable();

  $(document).on("click", ".addancmt", function(){

    var action = "add_announcement";
    var title = $('#title').val();
    var message = $('#message').val();
    var link = $('#link').val();

    $.ajax({
    url:"action.php",
    method:"POST",
    data:{action:action,title:title,message:message,link:link},
    success: function(data){}
    });
  });

  $(document).on("click", ".add_ancmtimages", function(){

    var ancmtid = $(this).data("id");

    $('#ancmtid').val(ancmtid);
    $('#addancmtimages').modal("show");
  });

  $('#upload_images').on('submit', function(){

    $.ajax({
      url:"upload.php",
      method:"POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,
      success: function(data){}
    });
  });

  $(document).on('click', '.view_ancmt', function(){

  var ancmt_id = $(this).data("id");
  var action = "view_ancmt&image";

    $.ajax({
    url:"action.php",
    method:"POST",
    data:{action:action, ancmt_id:ancmt_id},
    success:function(data)
    {
      $('#viewancmt').modal('show');
      $('#file_list').html(data);
    }
    });
  

 });

  $(document).on("click", ".delete_ancmt", function(){
            
    var ancmt_id = $(this).data("id");

    var action = "ancmt_delete";

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
          data:{action:action, ancmt_id:ancmt_id},
          success:function(data)
          {
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Delete Announcement Successfully',
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

  $(document).on("click", ".delete_image", function(){
            
    var img_id = $(this).data("id");
    var img_path = $(this).data("lnk");

    var action = "img_delete";

        
    $.ajax({
    url:"action.php",
    method:"POST",
    data:{action:action, img_id:img_id,img_path:img_path},
    success:function(data)
    {
      toastr.success("Delete Image Successful");
    }
    });
  });
});
</script>

