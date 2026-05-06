<?php
    include "include/navigationheader.php"; 
    include "time.php";
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1> <i class="fas fa-bell"></i> <b>Notification</b> 
                            <ol class="breadcrumb float-sm-right" style="font-size:15px;">
                                <li class="breadcrumb-item"><a href="../index.php"><i class="fas fa-home"></i> Home</a></li>
                                <li class="breadcrumb-item active">Notification</li>
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
                            <h3 class="card-title"><i class="far fa-list-alt"></i> List of Notification</h3>
                        </div>
                        <div class="card-body p-1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive px-2 pt-3">
                                        <table id="request_table" class="table table-sm" >
                                            <thead>
                                                <th colspan="6"><input type="checkbox" name="checkall" id="checkall" onClick="check_uncheck_checkbox(this.checked);" /></th> 
                                            </thead>
                                            <tbody>
                                            <?php
                                                $schnotif=mysqli_query($conn,"SELECT * FROM sch_notif ORDER BY date ASC");
                                                while($row=mysqli_fetch_assoc($schnotif)){
                                                    $stud = mysqli_query($conn,"SELECT * FROM student WHERE id='".$row['studid']."'");
                                                    $rowstudinfo = mysqli_fetch_assoc($stud);
                                            ?>
                                                <tr id="<?php echo $row['id'];?>" style="background: <?= ($row['status'] == 0 ? 'yellow':'');?>">
                                                <td><input type="checkbox" class="checked" value="<?php echo $row['id'];?>" name="select"></td>
                                                <td><?php echo $row['title'];?></td>
                                                <td><?php echo $rowstudinfo['fname']; ?> <?php echo $rowstudinfo['mname']; ?>. <?php echo $rowstudinfo['lname']; ?> <?php echo $row['message'];?></td>
                                                <td><?php echo $row['date'];?></td>
                                                <td><?php echo Time_Convert($row['date']);?></td>
                                                <td><button style="background-color: inherit; border: none; color: blue;" class="view_notif" data-id="<?php echo $row['id'];?>" >View</button></td>
                                                </tr>
                                            <?php
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="btn-group py-2 px-3">
                                    <button type="submit" class="delete_notif btn btn-danger btn-sm elevation-3"><i class="fas fa-trash-alt"></i> Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>
<script>
$(document).on('click', '.delete_notif', function(){

    var id = [];

    $(".checked").each(function(){
        if($(this).is(":checked")){
            id.push($(this).val())
        }
    });

    id = id.toString();

    var action = "delete_notification";

        $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action,id:id},
        success:function(data)
        {
               if(data == 'success'){
                Swal.fire({
                position: 'top-center',
                title: 'Selected Request Delete Successful',
                icon: data,
                showConfirmButton: false,
                timer: 2000
                }).then((result) => {
                    location.reload(true);
                });
                }else if(data=='warning'){
                Swal.fire({
                position: 'top-center',
                title: 'Checked the Box if you want to Delete Notification',
                icon: data,
                showConfirmButton: false,
                timer: 2000
                }).then((result) => {
                    location.reload(true);
                });
                }

            var ele=document.getElementsByName('select');  
                for(var i=0; i<ele.length; i++){  
                    if(ele[i].type=='checkbox')  
                        ele[i].checked=false;  
                }
            var ele=document.getElementsByName('checkall',);  
            for(var i=0; i<ele.length; i++){  
                if(ele[i].type=='checkbox')  
                    ele[i].checked=false;  
                }
        }
        });
});
    $(document).on("click", ".view_notif", function () {

        var notifid = $(this).data("id");

        var action = "view_notification";

            $.ajax({
            url:"action.php",
            method:"POST",
            data:{action:action,notifid:notifid},
            success:function(data)
            {
                if(data == 'New Applicant'){
                    window.location.href= "scholarinfo.php";
                }else if(data == 'Student Sent Files'){
                    window.location.href= "documentfiles.php";
                }
            }
            });
    });

    $('#viewmessage').on('hidden.bs.modal', function () {
    location.reload();
    })
   function check_uncheck_checkbox(isChecked) {
        if(isChecked) {
            $('input[name="select"]').each(function() { 
                this.checked = true; 
            });
        } else {
            $('input[name="select"]').each(function() {
                this.checked = false;
            });
        }
    }
    $('#request_table').DataTable({
        "searching": true,
        "ordering": false,
    });
</script>