<?php
    include "include/navigationheader.php";
    include "time.php";
?>
<div class="wrapper">
    <div class="content-wrapper">
     <section class="content pt-2">
       <div class ="card" id="index-color">
         <div class="card-header">
            <div class="d-flex align-items-center">
              <button type="button" onclick="history.go(-1);" class="float-left btn btn-sm"><i class="fas fa-arrow-left" id="arrow-back"></i></button>
              <h3 class="card-title w-100"><img src="img/megaphone.png" height="24px" width="24px" id="icon-img-shadow"> Scholarship Announcement</h3>
          </div>
         </div>
       </div>
        <?php
            $ancmt = mysqli_query($conn, "SELECT * FROM sch_ancmt ORDER BY date DESC");
            $check = true;

            while($row=mysqli_fetch_assoc($ancmt)){
              
              $check = false;
              $date = $row['date'];
        ?>
     <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <h4 class="my-3"><img src="../../img/scholarshipicon.png" alt="Avatar"class="center" width="30px"> Scholarship Office</h4>
              <hr>
              <h5><?php echo $row['title'];?></h5>
              <?php echo $row['message'];?><br>
              <a href="<?php echo $row['link']?>"><?php echo $row['link']?></a>
              <hr>
              <div class="py-2">
                  <?php
                    $img=mysqli_query($conn,"SELECT * FROM sch_ancmtimg WHERE ancmt_id='".$row['id']."' ORDER BY ancmt_id DESC LIMIT 2 OFFSET 0");
                   while($row1=mysqli_fetch_assoc($img)){
                  ?>
                   <img src="../../scholarship/home/<?php echo $row1['image_path'];?>" class="view_images img-responsive" data-id="<?php echo $row['id'];?>" width="150" height="150">
                <?php
                   }
                ?>
              </div>
              <hr>
                <span><?php echo Time_Convert($date);?></span>
            </div>
          </div>
        </div>
      </div>
        <?php
            }if($check){
        ?>
          <div class='text-center'><p>Empty Announcement</p></div>
        <?php
          }
        ?>
    </section>
    </div>
</div>
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <button type="button" class="close text-right px-2 py-2" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      <div class="modal-body p-0 text-center" id="file_list">
      </div>
    </div>
  </div>
</div>
<script>
  $(document).on('click', '.view_images', function(){

    var src = $(this).attr("src");
    var anmctid = $(this).data("id");
    var action = "view_postimage";

    $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action, src:src,anmctid:anmctid},
        success:function(data)
        {
            $('#file_list').html(data);
            $('#myModal').modal('show');
        }
        });
  });
</script>

