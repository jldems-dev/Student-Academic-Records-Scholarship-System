<?php
    include "include/navigationheader.php"; 
    include "time.php";

   $query = mysqli_query($conn, "SELECT * FROM student WHERE studid='$id'");

    $row = mysqli_fetch_array($query);
        $newid = $row['id'];

    $r = mysqli_query($conn, "SELECT * FROM notification WHERE studid = '$newid' ORDER BY date DESC");
?>
<div class="content-wrapper" style="padding-top: 75px">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 p-0">
                    <?php
                    include "alert.php";
                    ?>
                    <div class="card" id="index-color">
                        <div class="card-header">
                            <h3 class="card-title"> <i class="fas fa-bell"></i> Notifications</h3>
                            <button type="button" class="clear_log btn btn-sm btn-danger float-right elevation-3" data-id="<?php echo $newid;?>" ><i class="fas fa-trash-alt"></i> Clear</button>
                        </div>
                    </div>
                    <?php
                        $check=true;
                        while($row1=mysqli_fetch_assoc($r)){
                        $check=false;
                    ?>
                    <div class="card mt-2" style="background: <?= ($row1['active'] == 0 ? 'yellow':'');?>">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item px-2 pt-2">
                                <p>
                                    <b><?php echo $row1['notif_name']?>: </b> <?php echo $row1['term']?><br>
                                        <?php echo $row1['message']?><br>
                                    <b>Date:</b> <?php echo $row1['date'];?><br>
                                    <hr>
                                </p>
                            </li>
                        </ul>
                        <div class="col-lg-12">
                            <?php echo Time_Convert($row1['date']);?>
                            <button type="submit" id="view_notif" class="mx-2 my-1 view_notif pb-1 float-right btn btn-primary btn-sm elevation-3" data-id="<?php echo $row1['id']?>" data-name="<?php echo $row1['notif_name']?>"><i class="fas fa-eye"></i></button>
                        </div>
                    </div>
                    <?php
                        }if($check){
                            
                        echo "<p colspan='6' class ='text-center pt-2'>Empty Notification</p>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
$(document).ready(function(){

    $(document).on("click", ".view_notif", function () {
        var norif_name = $(this).data('name');
        var notif_id = $(this).data('id');
        var action = "view_notification";

            $.ajax({
            url:"action.php",
            method:"POST",
            data:{action:action, norif_name:norif_name,notif_id:notif_id},
            success:function(data)
            {
                 if(data == 'Grade'){
                    window.location = 'my_grades.php';
                }else if(data == 'Announcement'){
                    window.location = 'my_ancmt.php';
                }else if(data == 'Scholarship'){
                    window.location = 'my_scholarprog.php';
                }else if(data == 'Request'){
                    window.location = 'my_sent.php';
                }
            }
            });
    });
    $(document).on('click','.clear_log', function(){

        var studid = $(this).data("id");

        var action = "clear";

        $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action,studid:studid},
        success:function(data)
        {
       location.reload();
        }
        });
    });
});
</script>