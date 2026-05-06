<?php
    include('../include/navigationheader1.php'); 
    $querydp = mysqli_query($conn,"SELECT * FROM department");
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1><img src="../../img/department.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"> <b>Department</b> 
                            <ol class="breadcrumb float-sm-right" style="font-size:15px;">
                                <li class="breadcrumb-item"><a href="../index.php"><i class="fas fa-home"></i> Home</a></li>
                                <li class="breadcrumb-item active">Department</li>
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
                            <button type="button" class="btn float-left btn-sm"><h5 class="card-title" id="arrow-back"><i class="fas fa-plus-circle"></i> <b>Add New Department</b></h5></button> 
                            <button type="button" class="btn float-right btn-sm" data-card-widget="collapse" id="card-header"><i class="fas fa-caret-down"></i></button>
                        </div>
                        <div class="card-body">
                            <form method="post" id="upload_form" enctype='multipart/form-data' class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Department</label>
                                    <input type="tel" class="form-control" name="dpment" id="dpment" placeholder="Department Abbreviation" style="text-transform:capitalize" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Department Full Name</label>
                                    <input type="text" class="form-control" name="dp_dscrption" id="dp_dscrption" placeholder="Department Name" style="text-transform: capitalize;" required>
                                </div>
                                <div class="col-md-12 pt-3 text-right">
                                    <button type="submit" class="addment btn btn-sm btn-dark elevation-3" id="button-all"><i class="fas fa-plus-square"></i> Add</button>
                                    <input type="hidden" name="coursename" id="coursename"/>
                                    <input type="hidden" name="action" id="action"/>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                        <h3 class="card-title"><i class="far fa-list-alt"></i> List of Department</h3>
                        </div>
                        <div class="table-responsive px-2 pt-3">
                            <table id="data_table" class="table table-striped table-bordered table-sm" >
                                <thead>
                                    <th>No.</th>
                                    <th>Logo</th>
                                    <th>Department Abbreviation</th>
                                    <th>Department Full Name</th>
                                    <th></th>
                                    <th>Option</th> 
                                </thead>
                                <tbody>
                                <?php 
                                    $count = 1;
                                    while($row = mysqli_fetch_array($querydp)){
                                ?>
                                    <tr>
                                        <td ><?php echo $count++;?></td>
                                        <td><img src="<?php echo $row['logo_path'];?>" class="brand-image img-circle" width="40x"></td>
                                        <td><?php echo $row['dp_name'];?></td>
                                        <td><?php echo $row['dp_description'];?></td>
                                        <td width="20%">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="file" class="upload_image custom-file-input" data-id="<?php echo $row['id'];?>" data-name="<?php echo $row['dp_name'];?>" accept="image/*">
                                                    <label class="custom-file-label" for="upload_image">Choose Logo</label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                        <button class="update_dpment btn btn-primary btn-sm btn-secondary elevation-3"
                                        data-id="<?php echo $row['id'];?>" 
                                        data-name= "<?php echo $row['dp_name'];?>" 
                                        data-dscptn = "<?php echo $row['dp_description'];?>" 
                                        data-toggle="modal"
                                        data-target="#update_dpment"><i class="fas fa-edit"></i></button>
                                        <button class="delete_dpment btn btn-primary btn-sm btn-danger elevation-3"  
                                        data-id="<?php echo $row['id'];?>" data-lgpth=<?php echo $row['logo_path'];?>><i class="fas fa-trash-alt"></i></button>
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
<div class="modal fade" id="update_dpment">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="header pl-3 pt-3">
                <h5 class="title"><b><i class="fas fa-edit"></i> Update Department Information</b></h5>
            </div>
            <div class="modal-body">
                <form method="post" id="update_form" enctype='multipart/form-data'>
                    <div class="form-group pt-3">
                        <label class="form-label">Department Name</label>
                        <input type="tel" class="form-control" name="updpment" id="updpment" required>
                    </div>
                    <div class="form-group pt-3">
                        <label class="form-label">Department Description</label>
                        <input type="text" class="form-control" name="updp_dscrption" id="updp_dscrption" style="text-transform: capitalize;" required>
                    </div>
                    <div class="form-group pt-3">
                        <button type="submit" id="button-all" class="updatecor btn btn-sm btn-dark elevation-3"><i class="fas fa-save"></i> Update </button>
                        <button type="submit" class="btn btn-danger float-right btn-sm elevation-3" data-dismiss="modal"><i class="fas fa-times-circle"></i></button>
                        <input type="hidden" name="dpment_id" id="dpment_id"/>
                        <input type="hidden" name="dpment_name" id="dpment_name"/>
                        <input type="hidden" name="action" id="action"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="uploadimageModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title">Crop Profile Picture</p>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 text-center">
                            <div id="image_demo"></div>
                        </div>
                        <div class="btn-group col-lg-12" id="index-color1">
                            <button class="btn crop_image btn-sm" data-id="<?php echo $row['id'];?>"><i class="fas fa-crop"></i> Crop & Upload Image</button>
                            <button class="btn  btn-sm" data-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

$(document).ready(function(){

    $(function () {
    bsCustomFileInput.init();
    });

    $image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
      width:200,
      height:200,
      type:'circle'
    },
    boundary:{
      width:300,
      height:300
    }
  });

  $(document).on('change','.upload_image', function(){

    var dpment_id = $(this).data("id");
    var dpment_name = $(this).data("name");

    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
    $('#dpment_id').val(dpment_id);
    $('#dpment_name').val(dpment_name);
    $('#uploadimageModal').modal('show');
  });

  $('.crop_image').click(function(event){

     var dpment_id = $('#dpment_id').val();
     var dpment_name = $('#dpment_name').val();

    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
        
      $.ajax({
        url:'upload.php',
        type:'POST',
        data:{"image":response,dpment_id:dpment_id,dpment_name:dpment_name},
        success:function(data){
            location.reload();
        }
      });
    });
  });

    $('#data_table').DataTable();

    $(document).on("click", ".addment", function(){

     
        var action = "add_dpment";
        var dpment = $('#dpment').val();
        var dp_dscrption = $('#dp_dscrption').val();

        $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action,dpment:dpment, dp_dscrption:dp_dscrption},
        success: function(data)
        {
        }
        });
    });

    $(document).on("click", ".update_dpment", function(){

        var dpment_id = $(this).data("id");
        var updpment = $(this).data("name");
        var updp_dscrption = $(this).data("dscptn");

        $('#dpment_id').val(dpment_id);
        $('#updpment').val(updpment);
        $('#updp_dscrption').val(updp_dscrption);
        $('#update_dpment').modal('show');
        $('#action').val("update_dpment");
    });

    $(document).on('click','.updatecor', function(){

        var dpment_id = $('#dpment_id').val();
        var updpment = $('#updpment').val();
        var updp_dscrption = $('#updp_dscrption').val();

        var action = $('#action').val();

        if(dpment_id != '')
        {
           
        $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action,dpment_id:dpment_id, 
        updpment:updpment,updp_dscrption:updp_dscrption},
        success:function(data)
        {
        }
        });
        }
        else
        {
        alert("Error");
        }
    });

    $(document).on("click", ".delete_dpment", function(){
            
        var dpid = $(this).data("id");
        var lgpth = $(this).data("lgpth");
    
        var action = "delete_dp";
    
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
            data:{action:action, dpid:dpid,lgpth:lgpth},
            success:function(data)
            {
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Delete Department Successful!',
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
});
</script>