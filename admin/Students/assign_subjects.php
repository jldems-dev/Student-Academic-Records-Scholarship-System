<?php
    include "../../config.php";
    $studid = $_POST['id'];
    $sy = $_POST['sy'];
    $sem = $_POST['sem'];
    $course = $_POST['course'];
    $year = $_POST['year'];
    $recordid = $_POST['recordid'];

    $studentinfo = mysqli_query($conn, "SELECT * FROM student WHERE id='$studid'");
    $rowinfo = mysqli_fetch_assoc($studentinfo);
?>
<div class="container-fluid">
     <div class="col-12">
        <div class="header">
            <h3><span class="glyphicon glyphicon-user"></span><i class="fas fa-th-list"></i> List of Subjects</h3>
        </div>
        <div class="table-responsive px-2 pt-3">
            <table id="data_subjects" class="table table-striped table-bordered table-sm" >
                <thead>
                    <th>#</th> 
                    <th width="70px">Subject Code</th>
                    <th>Subject Title</th>
                    <th>Course</th>
                    <th>Year</th>
                    <th>Units</th>
                    <th>Select</th>
                    <th>Status</th>
                </thead>
                <?php
                $count=1;
                    $subjects = mysqli_query($conn,"SELECT * FROM subject WHERE course='$course' AND sem='$sem' AND year='$year'");
                    while ($row = mysqli_fetch_assoc($subjects)) {
                ?>
                <tbody>
                    <tr id="<?php echo $row['id'];?>">
                        <td><?php echo $count++;?></td>
                        <td><?php echo $row['code'];?></td>
                        <td><?php echo $row['title'];?></td>
                        <td><?php echo $row['course'];?></td>
                        <td><?php echo $row['year'];?></td>
                        <td><?php echo $row['unit'];?></td>
                        <td class="text-center" style="vertical-align: middle;">
                        <input type="checkbox" class="checked" name="select" value="<?php echo $row['id'];?>"/>
                        </td>
                        <td>
                            <?php 
                            $checked = mysqli_query($conn,"SELECT * FROM student_subjects WHERE studid='$studid' AND subid='".$row['id']."'");
                            
                            if ($check = mysqli_num_rows($checked) > 0){ echo  'Already Assigned';}
                            ?>
                        </td>
                    </tr>
                </tbody>
                <?php
                    }
                ?>
            </table>
            <div class="btn-group py-2">
                <button class="btn btn-sm btn-dark elevation-3" data-dismiss="modal" id="button-all"><i class="fas fa-times-circle"></i> Close </button>
                <button type="submit" class="assign_subjects btn btn-dark btn-sm elevation-3" data-id="<?php echo $studid; ?>" data-sem="<?php echo $sem;?>" data-sy="<?php echo $sy;?>" data-recordid="<?php echo $recordid;?>" id="button-all"><i class="fas fa-plus-square"></i> Assign Subjects</button>
                <button type="submit" class="btn btn-dark btn-sm elevation-3" onclick='selects()' id="button-all"><i class="fas fa-check-square"></i> Select All</button>
				<button type="submit" class="btn btn-dark btn-sm elevation-3" onclick='deSelect()' id="button-all"><i class="far fa-check-square"></i> Deselect All</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
     $('#data_subjects').DataTable();

$(document).ready(function(){

     $(document).on('click', '.assign_subjects', function(){

        var studentid = $(this).data("id");
        var sy = $(this).data("sy");
        var sem = $(this).data("sem");
        var recordid = $(this).data("recordid");
        var id = [];

        $(".checked").each(function(){
            if($(this).is(":checked")){
                id.push($(this).val())
            }
        });

        id = id.toString();

        var action = "add_subjects";

            $.ajax({
            url:"action.php",
            method:"POST",
            data:{action:action,studentid:studentid,
            id:id,sy:sy,sem:sem,recordid:recordid},
            success:function(data)
            {
            var ele=document.getElementsByName('select');  
                for(var i=0; i<ele.length; i++){  
                    if(ele[i].type=='checkbox')  
                        ele[i].checked=false;  
                }
                location.reload(true);
            }
            });
    });
});
     function selects(){
        var ele=document.getElementsByName('select');
        for(var i=0; i<ele.length; i++){  
            if(ele[i].type=='checkbox'){
                ele[i].checked=true;
            }
        }  
    } 
    function deSelect(){  
        var ele=document.getElementsByName('select');
        for(var i=0; i<ele.length; i++){  
            if(ele[i].type=='checkbox'){
                ele[i].checked=false;
            }
        }  
    } 
</script>