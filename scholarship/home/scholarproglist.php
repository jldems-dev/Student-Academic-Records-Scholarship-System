<?php
  include "include/navigationheader.php"; 
  $program_id = $_GET['progid'];
  $program_name = $_GET['progname'];

  $query = mysqli_query($conn, "SELECT * FROM sch_name WHERE scholarprogram_id='$program_id'");

 ?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
      <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h1><?php echo  $program_name;?>
                      <ol class="breadcrumb float-sm-right" style="font-size:15px;">
                          <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                          <li class="breadcrumb-item active"><?php echo  $program_name;?></li>
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
                <button type="button" class="btn float-left btn-sm"><h5 class="card-title" style="color: white;"><i class="fas fa-plus-circle"></i> <b>Add New Scholarship</b></h5></button> 
                <button type="button" class="btn float-right btn-sm" data-card-widget="collapse" id="arrow-back"><i class="fas fa-caret-down"></i></button>
            </div>
            <div class="card-body">
              <p id="msg" class="text-danger"></p>
              <form method="post" id="upload_form" enctype='multipart/form-data' class="row">
                  <div class="col-md-4 pt-3">
                      <label class="form-label">Scholarship Name</label>
                      <input type="text" class="form-control" name="name" id="name" style="text-transform: capitalize;" placeholder="Enter Scholarship Name" required>
                  </div>
                  <div class="col-md-4 pt-3">
                      <label class="form-label">Link for Full Information</label>
                      <input type="text" class="form-control" name="link" id="link" placeholder="Paste Link" required>
                  </div>
                  <div class="col-md-4 pt-3">
                        <label class="form-label">School Year</label>
                        <select id="sy" name="sy" class="form-control" required>
                        <option value="">Select Year</option>
                        <?php
                            for( $y = 2020; $y <= 2100; $y++ ) {
                                ?>
                                    <option value="<?php echo $y-1; ?>-<?php echo $y; ?>"><?php echo $y-1; ?>-<?php echo $y; ?></option>
                                <?php
                            }
                        ?>
                        </select>
                  </div>
                  <div class="col-md-6 pt-3">
                    <label for="form-label">Requirements</label>
                    <textarea class="form-control" row="3" onkeyup="textAreaAdjust(this)" style="overflow:hidden" name="rqments" id="rqments" maxlength="2000" placeholder="Paste Requirements" required></textarea>
                  </div>
                  <div class="col-md-6 pt-3">
                    <label for="form-label">Qualification</label>
                    <textarea class="form-control" row="3" onkeyup="textAreaAdjust(this)" style="overflow:hidden" name="qlfcation" id="qlfcation" maxlength="2000" placeholder="Paste Qualification" required></textarea>
                  </div>
                  <div class="col-md-12 pt-3 text-right">
                      <button type="submit" class="addsch btn btn-sm btn-dark elevation-3" data-id="<?php echo $program_id;?>" id="button-all"><i class="fas fa-plus-square"></i> Add</button>
                      <input type="hidden" name="action" id="action"/>
                      <input type="hidden" name="id" id="id"/>
                  </div>
                </form>
              </div>
            </div>
          <div class="card">
            <div class="card-header">
              <h2 class="card-title"><i class="far fa-list-alt"></i> List of Scholarship Under <?php echo  $program_name;?></h2>
            </div>
            <div class="table-responsive px-2 pt-3">
              <table id="scholar_table" class="table table-striped table-bordered table-sm" >
                  <thead>
                      <th width="8%">No.</th>
                      <th>Scholarship Name</th>
                      <th>School Year</th>
                      <th width="8%">Option</th>
                  </thead>
                  <tbody>
                  <?php
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($query)){
                  ?>
                      <tr>
                        <td><?php echo $count++;?></td>
                        <td> <?php echo $row['name'];?></td>
                        <td> <?php echo $row['sy'];?></td>
                        <td style="vertical-align: middle;">
                          <a  class="view_schinformation btn btn-sm btn-primary elevation-3" href="sch_information.php?schprogid=<?php echo $row['id'];?>"><i class="fas fa-eye"></i></a>
                          <button  class="delete_scholar btn btn-sm btn-danger elevation-3" id="<?php echo $row['id'];?>"><i class="fas fa-trash-alt"></i></button>
                        </td>
                      </tr>
                  <?php
                      }
                  ?>
                  </tbody>
              </table>
            </div>
            <div class=" mx-2 my-2">
                <button class="btn btn-sm btn-dark elevation-3" onclick="history.go(-1);" id="button-all"><i class="fas fa-backspace"></i> Back </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script type="text/javascript">

function textAreaAdjust(element) {
  element.style.height = "1px";
  element.style.height = (25+element.scrollHeight)+"px";
}

$(document).ready(function(){

    $('#scholar_table').DataTable();

  $(document).on("click", ".addsch", function(){

    var id = $(this).data("id");

    var action = "add_sch";
    var rqments = $('#rqments').val();
    var qlfcation = $('#qlfcation').val();
    var link = $('#link').val();
    var name = $('#name').val();
    var sy = $('#sy').val();

    $.ajax({
    url:"action.php",
    method:"POST",
    data:{action:action,link:link,
    name:name,id:id,rqments:rqments,
    qlfcation:qlfcation,sy:sy},
    success: function(data)
      {
      }
    });
  });
  $(document).on("click", ".delete_scholar", function(){
            
    var program_id = $(this).attr("id");

    var action = "delete_scholar";

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete it!'
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
          title: 'Delete Scholarship Successful!',
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

