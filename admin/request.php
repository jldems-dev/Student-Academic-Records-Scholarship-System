<?php
    include('include/navigationheader.php'); 
    include "time.php";
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1> <i class="fas fa-envelope-open-text"></i> <b>Request</b> 
                            <ol class="breadcrumb float-sm-right" style="font-size:15px;">
                                <li class="breadcrumb-item"><a href="../index.php"><i class="fas fa-home"></i> Home</a></li>
                                <li class="breadcrumb-item active">Request</li>
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
                            <h3 class="card-title"><i class="far fa-list-alt"></i> List of Request</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-header text-center">
                                    <h4>Student Request Grades</h4>
                                </div>
                                <div class="table-responsive px-2 pt-3">
                                    <table id="request_table" class="table table-sm" >
                                        <thead>
                                            <th><input type="checkbox" name="checkall" id="checkall" onClick="check_uncheck_checkbox1(this.checked);" /></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </thead>
										<tbody>
                                        <?php
                                            $request=mysqli_query($conn,"SELECT * FROM request WHERE type='Grades' ORDER BY date ASC");
                                            while($row=mysqli_fetch_assoc($request)){
                                        ?>
                                            <tr id="<?php echo $row['id'];?>" style="background: <?= ($row['status'] == 0 ? 'yellow':'');?>">
                                            <td><input type="checkbox" class="checked" value="<?php echo $row['id'];?>" name="select1"></td>
                                            <td><?php echo $row['type'];?></td>
                                            <td><?php echo $row['studid'];?></td>
                                            <td><?php echo $row['student_fullname'];?></td>
                                            <td><?php if($row['status'] == 0){echo "Unread";}else{echo "Read";}?></td>
                                            <td><?php echo Time_Convert($row['date']);?></td>
                                            <td><button style="background-color: inherit; border: none; color: blue;" class="view_account"data-id="<?php echo $row['id']?>" data-toggle="modal" data-target="#viewmessage">View</button></td>
                                            </tr>
                                        <?php
                                            }
                                        ?>
										</tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-header text-center">
                                    <h4>Student Request Account</h4>
                                </div>
                                <div class="table-responsive px-2 pt-3">
                                    <table id="account_table"  class="table table-sm">
                                        <thead>
                                            <th><input type="checkbox" name="checkall" id="checkall" onClick="check_uncheck_checkbox(this.checked);" /></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </thead>
										<tbody >
                                        <?php
                                            $request=mysqli_query($conn,"SELECT * FROM request WHERE type='Account' ORDER BY date ASC");
                                            while($row=mysqli_fetch_assoc($request)){
                                        ?>
                                            <tr id="<?php echo $row['id'];?>" style="background: <?= ($row['status'] == 0 ? 'yellow':'');?>">
                                            <td><input type="checkbox"  name="select" class="checked" value="<?php echo $row['id'];?>"></td>
                                            <td><?php echo $row['type'];?></td>
                                            <td><?php echo $row['studid'];?></td>
                                            <td><?php echo $row['student_fullname'];?></td>
                                            <td><?php if($row['status'] == 0){echo "Unread";}else{echo "Read";}?></td>
                                            <td><?php echo Time_Convert($row['date']);?></td>
                                            <td>
                                                <button style="background-color: inherit; border: none; color: blue;" class="view_account" data-id="<?php echo $row['id']?>"data-toggle="modal" data-target="#viewmessage">View</button>
                                                <input type="hidden" name="action" id="action"/>
                                            </td>
                                            </tr>
                                        <?php
                                            }
                                        ?>
										</tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="btn-group py-2 px-3">
                                <button type="submit" class="delete_allmessage btn btn-danger btn-sm elevation-3"><i class="fas fa-trash-alt"></i> Delete</button>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="viewmessage">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-header pl-3 pt-3">
                <h5 class="title"><b>Read Request</b></h5>
            </div>
            <div class="modal-body" id="file_list">
            </div>
        </div>
    </div>
</div>
<?php
if(isset($_POST['delete'])){
    $query = "TRUNCATE TABLE `log` "; 

    $result = mysqli_query($conn,$query);
    echo "Clear Logs Successfully";
    }
?>
<script>
$(document).on('click', '.delete_allmessage', function(){

    var id = [];

    $(".checked").each(function(){
        if($(this).is(":checked")){
            id.push($(this).val())
        }
    });

    id = id.toString();

    var action = "delete_all";

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
                title: 'Checked the Box if you want to Delete Request',
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
            var ele=document.getElementsByName('select1',);  
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
    $(document).on("click", ".view_account", function () {
        var requestid = $(this).data('id');
        var action = "view_message";

            $.ajax({
            url:"action.php",
            method:"POST",
            data:{action:action, requestid:requestid},
            success:function(data)
            {
                $('#file_list').html(data);
            }
            });
    });
    $(document).on("click", ".delete_request", function () {
        var requestid = $(this).data('id');
        var action = "delete_request";

            $.ajax({
            url:"action.php",
            method:"POST",
            data:{action:action, requestid:requestid},
            success:function(data)
            {
                Swal.fire({
                position: 'top-center',
                title: 'Request Delete Successful',
                icon: data,
                showConfirmButton: false,
                timer: 2000
                }).then((result) => {
                    location.reload(true);
                });
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
    function check_uncheck_checkbox1(isChecked) {
        if(isChecked) {
            $('input[name="select1"]').each(function() { 
                this.checked = true;  
            });
        } else {
            $('input[name="select1"]').each(function() {
                this.checked = false;
            });
        }
    }
    $('#account_table').DataTable({
        "searching": true,
        "ordering": false,
    });
    $('#request_table').DataTable({
        "searching": true,
        "ordering": false,
    });
</script>