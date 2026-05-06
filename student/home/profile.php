<?php
    include "include/navigationheader.php"; 

    $query = mysqli_query($conn, "SELECT * FROM student WHERE studid='$id'");

    $row = mysqli_fetch_array($query);

    $myavatar = mysqli_query($conn, "SELECT * FROM userdata WHERE username='$id'");
    $rowavatar = mysqli_fetch_assoc($myavatar);
?>
<div class="content-wrapper" style="padding-top: 75px">
    <section class="content  p-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card" id="index-color">
                        <div class="card-body p-3">
                            <div class="text-center py-3" id="index-color1">
                                <img src="<?php echo $rowavatar['ava_location'];?>" class="profile-user-img img-fluid img-circle" id="myImg">
                            </div>
                            <p class="text-left pt-5">
                            <b>Information</b><br/>
                            <hr>
                            <b>Name: </b> <?php echo $row['fname'];?> <?php echo $row['mname'];?>. <?php echo $row['lname'];?><br/>
                            <b>Course: </b> <?php echo $row['course'];?><br/>
                            <b>Year: </b> <?php echo $row['year'];?><br/>
                            <b>Section: </b> <?php echo $row['section'];?><br/>
                            <b>Email: </b> <?php echo $row['email'];?><br/>
                            </p>
                            <button type="button" class="btn btn-sm elevation-3" onclick="location.href='settings.php';" id="index-color1"><i class="fas fa-user-edit"></i> Edit Account</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal" id="myModal">
  <div class="modal-dialog" >
    <div class="modal-content" id="m-color">
      <div class="modal-body p-0 text-center" >
       <img id="img01" class="img-circle py-3 px-3">
       <div class="py-2 px-2">
          <span aria-hidden="true" class="close">&times;</span>
      </div>
      </div>
    </div>
  </div>
</div>
<script>
  
var modal = document.getElementById("myModal");
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

var span = document.getElementsByClassName("close")[0];
span.onclick = function() { 
  modal.style.display = "none";
}

$(function () {
bsCustomFileInput.init();
});

$(document).ready(function(){

    $image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
      width:200,
      height:200,
      type:'square' //circle
    },
    boundary:{
      width:300,
      height:300
    }
  });

  $('#upload_image').on('change', function(){
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
    $('#uploadimageModal').modal('show');
  });

  $('.crop_image').click(function(event){
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
      $.ajax({
        url:'uploadavatar.php',
        type:'POST',
        data:{"image":response},
        success:function(data){
          $('#uploadimageModal').modal('hide');
          location.reload();
        }
      })
    });
  });

    var tele = document.querySelector('#userid');

        tele.addEventListener('keyup', function(e){

        if (event.key != 'Backspace' && (tele.value.length == 4 || tele.value.length == 9)){
        tele.value += '-';
        }
    });

    $(document).on('click','.save_teach', function(){

        var teach_id = $(this).attr("name");
        var user_teach_id = $(this).data("id");

        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var userid = $('#userid').val();

        var action = "updateuser";

        $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action,fname:fname, lname:lname,userid:userid,teach_id:teach_id,user_teach_id:user_teach_id},
        success:function(data)
        {
            alert(data);
        }
        });
    });

    $(document).on('click','.update_pass', function(){

        var user_teach_id = $(this).data("name");

        var currentPassword = $('#currentPassword').val();
        var newPassword = $('#newPassword').val();
        var confirmPassword = $('#confirmPassword').val();

        var action = "updatepass";

        $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action,currentPassword:currentPassword, newPassword:newPassword,confirmPassword:confirmPassword,user_teach_id:user_teach_id},
        success:function(data)
        {
            alert(data);
        }
        });
        });

});
</script>