<?php
  include "include/navigationheader.php";

  $schprogid = $_GET['schprogid'];

  $schinformation = mysqli_query($conn,"SELECT * FROM sch_name WHERE id='$schprogid'");
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
              <h2 class="card-title"><i class="fas fa-info-circle"></i> <?php echo $rowschi['name'];?> Information</h2>
            </div>
            <div class="card-body">
            <form method="post" id="upload_form" enctype='multipart/form-data' class="row">
                  <div class="col-md-4 pt-3">
                      <label class="form-label">Scholarship Name</label>
                      <input type="text" class="form-control" name="name" id="name" style="text-transform: capitalize;" value="<?php echo $rowschi['name'];?>" required>
                  </div>
                  <div class="col-md-4 pt-3">
                      <label class="form-label">Link</label>
                      <input type="text" class="form-control" name="link" id="link" value="<?php echo $rowschi['link'];?>" required>
                  </div>
                  <div class="col-md-4 pt-3">
                        <label class="form-label">School Year</label>
                        <select id="sy" name="sy" class="form-control" required>
                        <option value="<?php echo $rowschi['sy'];?>"><?php echo $rowschi['sy'];?></option>
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
                    <textarea class="form-control" rows="10" name="rqments" id="rqments"><?php echo $rowschi['requirements'];?></textarea>
                  </div>
                  <div class="col-md-6 pt-3">
                    <label for="form-label">Qualification</label>
                    <textarea class="form-control" rows="10" name="qlfcation" id="qlfcation" ><?php echo $rowschi['qualification'];?></textarea>
                  </div>
                  <div class="col-md-4 pt-3">
                        <label class="form-label">Application Form Status</label>
                        <select id="apform" name="apform" class="form-control" required>
                          <option><?php echo $rowschi['status']?></option>
                          <option>Unavailable</option>
                          <option>Available</option>
                        </select>
                    </div>
                </form>
                <div class="btn-group pt-3" >
                      <button class="btn btn-sm btn-dark elevation-3" onclick="window.history.go(-1); return false;" id="button-all"><i class="fas fa-backspace"></i> Back </button>
                      <button type="submit" data-id="<?php echo $schprogid;?>" class="update btn btn-sm btn-dark elevation-3" id="button-all"><i class="fas fa-save"></i> Update</button>
                      <button type="button"  onclick="location.href='applicants_list.php?schnameid=<?php echo $schprogid; ?>'" class="btn btn-sm btn-dark elevation-3" id="button-all"><i class="fas fa-eye"></i> Applicants</button>
                      <button type="button"  onclick="location.href='schname_stud_list.php?schnameid=<?php echo $schprogid; ?>'" class="btn btn-sm btn-dark elevation-3" id="button-all"><i class="fas fa-eye"></i> Student</button>
                      <input type="hidden" name="action" id="action"/>
                      <input type="hidden" name="id" id="id"/>
                  </div>
            </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script>
     $('#schinformation_table').DataTable();

     $(document).on('click', '.update', function(){
        var id = $(this).data("id");
        var name = $('#name').val();
        var link = $('#link').val();
        var sy = $('#sy').val();
        var rqments = $('#rqments').val();
        var qlfcation = $('#qlfcation').val();
        var apform = $('#apform').val();
        var action = "update_schinfo";

        $.ajax({
        url:"action.php",
        method:"POST",
        data:{name:name,link:link,
        action:action,rqments:rqments,
        qlfcation:qlfcation,id:id,sy:sy,apform:apform},
        success:function(data)
        {
          Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Update Scholarship Information Successful',
          showConfirmButton: false,
          timer: 2000
          }).then((result) => {
              location.reload(true);
          });
        }
        });
    });
</script>