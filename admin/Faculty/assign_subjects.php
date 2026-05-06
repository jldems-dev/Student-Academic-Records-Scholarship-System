<?php
    include "../include/navigationheader1.php"; 
    $facultyid = $_GET['facultyid'];
    $subjects = mysqli_query($conn,"SELECT * FROM subject");
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1><i class="fas fa-book-open"></i> <b>Subject Load </b> 
                            <ol class="breadcrumb float-sm-right" style="font-size:15px;">
                                <li class="breadcrumb-item"><a href="../index.php"><i class="fas fa-home"></i> Home</a></li>
                                <li class="breadcrumb-item active">Faculty</li>
                                <li class="breadcrumb-item active">Subject Load</li>
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
                        <h3 class="card-title"><i class="far fa-list-alt"></i> List of Subjects</h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive px-2 pt-3">
                            <table id="data_table" class="table table-striped table-bordered table-sm" >
                                <thead>
                                    <th>Subject Code</th>
                                    <th>Subject Title</th>
                                    <th>Course</th>
                                    <th>Year</th>
                                    <th>Units</th>
                                    <th>Select</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    <?php
                                        while ($row = mysqli_fetch_array($subjects)) {
                                    ?>
                                        <tr id="<?php echo $row['id'];?>">
                                            <td><?php echo $row['code'];?></td>
                                            <td><?php echo $row['title'];?></td>
                                            <td><?php echo $row['course'];?></td>
                                            <td><?php echo $row['year'];?></td>
                                            <td><?php echo $row['unit'];?></td>
                                            <td><input type="checkbox" class="checked" name="select" value="<?php echo $row['id'];?>"/></td>
                                            <td>
                                                <?php 
                                                $checked = mysqli_query($conn,"SELECT * FROM class WHERE teachid='$facultyid' AND subid='".$row['id']."'");
                                                
                                                if ($check = mysqli_num_rows($checked) > 0){ echo  'Already Assign';}
                                                ?>
                                            </td>
                                        </tr>
                                    
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <div class="btn-group py-2">
                                <button class="btn btn-sm btn-dark elevation-3" onclick="history.go(-1);" id="button-all"><i class="fas fa-backspace"></i> Back </button>
                                <button type="submit" class="assign_subjects btn btn-dark btn-sm elevation-3" data-id="<?php echo $facultyid; ?>" id="button-all"><i class="fas fa-plus-square"></i> Assign Subjects</button>
                                <button type="submit" class="btn btn-dark btn-sm elevation-3" onclick='selects()' id="button-all"><i class="fas fa-check-square"></i> Select All</button>
                                <button type="submit" class="btn btn-dark btn-sm elevation-3" onclick='deSelect()' id="button-all"><i class="far fa-check-square"></i> Deselect All</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">

$(document).ready(function(){

    $('#data_table').DataTable();

     $(document).on('click', '.assign_subjects', function(){

        var facultyid = $(this).data("id");
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
            data:{action:action,facultyid:facultyid,id:id},
            success:function(data)
            {
                if(data == 'success'){
                Swal.fire({
                position: 'top-center',
                title: 'New Subject Assigned Successful',
                icon: data,
                showConfirmButton: false,
                timer: 2000
                }).then((result) => {
                    location.reload();
                    });
                }else if(data=='error'){
                Swal.fire({
                position: 'top-center',
                title: 'Subject Already Assigned to Faculty',
                icon: data,
                showConfirmButton: false,
                timer: 2000
                }).then((result) => {
                    location.reload();
                    });
                }else if(data=='warning'){
                Swal.fire({
                position: 'top-center',
                title: 'Checked the Box if you want to Assign Subjects',
                icon: data,
                showConfirmButton: false,
                timer: 2000
                }).then((result) => {
                    location.reload();
                    });
                }

            var ele=document.getElementsByName('select');  
                for(var i=0; i<ele.length; i++){  
                    if(ele[i].type=='checkbox')  
                        ele[i].checked=false;  
                }
           
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