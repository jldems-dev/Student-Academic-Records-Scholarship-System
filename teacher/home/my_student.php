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
                            <h1><img src="../../img/facultystud.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"> My Student
                            <ol class="breadcrumb float-sm-right" style="font-size:15px;">
                                <li class="breadcrumb-item"><a href="../index.php"><i class="fas fa-home"></i> Home</a></li>
                                <li class="breadcrumb-item active">My Student</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-eye"></i> Subject Card</h3>
                        </div>
                        <div class="card-body p-0 pt-2">
                            <div class="container-fluid">
                                <div class="row">
                                    <?php
                                        $teach_classload = mysqli_query($conn, "SELECT * FROM class WHERE teachid = '$newid'");
                                        $check1 = true;
                                        while($row = mysqli_fetch_array($teach_classload)){
                                        $check1 = false;
                                        $subject = mysqli_query($conn,"SELECT * FROM subject  WHERE id='".$row['subid']."'");
                                        $rowsub=mysqli_fetch_assoc($subject);
                                    ?>
                                        <div class="col-lg-3 col-6">
                                            <div class="small-box bg-info">
                                                <div class="inner">
                                                    <h3><?php echo $rowsub['code']?></h3>
                                                    <p><?php echo $rowsub['title']?></p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-book"></i>
                                                </div>
                                                <a href="student_list.php?
                                                subjecode=<?php echo $rowsub['code'];?>&
                                                subjectitle=<?php echo $rowsub['title'];?>&
                                                subjectid=<?php echo $rowsub['id'];?>&
                                                sy=<?php echo $row['sy'];?>&
                                                tchid=<?php echo $row['teachid'];?>&
                                                course=<?php echo $rowsub['course'];?>&
                                                year=<?php echo $rowsub['year'];?>" class="small-box-footer">
                                                    View Students <i class="fas fa-arrow-circle-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <?php if($check1){
                                            echo '<div class="text-center py-2">Empty</div>';
                                        }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<style>
.modal.modal-fullscreen .modal-dialog {
  width:100vw;
  height:100vh;
  margin:0;
  padding:0;
  max-width:none;
}
.modal.modal-fullscreen .modal-content {

  height:auto;
  height:100vh;
  border-radius:0;
  border:none;
}
.modal.modal-fullscreen .modal-body {

  overflow-y:auto;
}
</style>
<div class="modal fade modal-fullscreen" id="allspreedsheet" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content ">
          <div class="header pl-3 pt-3">
              <h5 class="title"><b>View Announcement</b></h5>
          </div>
          <div class="modal-body" id="file_list">
          </div>
          <div>
          <button type="submit" class="btn btn-danger btn-sm float-right my-2 mx-2" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>
<script>
$('#datatable').DataTable();
$(document).ready(function(){

    $(document).on('click', '.submit_general_average', function(){

    var class_id = $(this).data("classid");
    var id = [];
   
    $(".checked").each(function(){
        if($(this).is(":checked")){
            id.push($(this).val())
        }
    });

     id = id.toString();
    

    var action = "average";

        $.ajax({
        url:"my_student_action.php",
        method:"POST",
        data:{action:action,class_id:class_id,id:id},
        success:function(data)
        {
        alert(data);

        var ele=document.getElementsByName('select_stud');  
            for(var i=0; i<ele.length; i++){  
                if(ele[i].type=='checkbox')  
                    ele[i].checked=false;  
            }
        }
        });
    });
    $(document).on('click', '.viewallspreed', function(){

    var subjectid = $(this).data("id");
    var subjeccode = $(this).data("name");
    var action = "view_allspreed";

        $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action, subjectid:subjectid,subjeccode:subjeccode},
        success:function(data)
        {
            $('#allspreedsheet').modal('show');
            $('#file_list').html(data);
        }
        });
    });
});
    function selects(){  
        var ele=document.getElementsByName('select_stud');  
        for(var i=0; i<ele.length; i++){  
            if(ele[i].type=='checkbox')  
                ele[i].checked=true;  
        }  
    }  
    function deSelect(){  
        var ele=document.getElementsByName('select_stud');  
        for(var i=0; i<ele.length; i++){  
            if(ele[i].type=='checkbox')  
                ele[i].checked=false;  
                
        }  
    }      
</script>