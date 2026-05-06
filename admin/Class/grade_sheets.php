<?php
    include "../include/navigationheader1.php";
    $gradesheet = mysqli_query($conn,"SELECT * FROM gradesheets");
    $rowgsheets = mysqli_fetch_assoc($gradesheet);
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1> <i class="fas fa-info-circle"></i><b> Class</b>
                            <ol class="breadcrumb float-sm-right" style="font-size:15px;">
                                <li class="breadcrumb-item"><a href="../index.php"><i class="fas fa-home"></i> Home</a></li>
                                <li class="breadcrumb-item active">Class</li>
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
                            <h3 class="card-title"><i class="fas fa-file-invoice"></i> Grade Sheets Percentrage Update</h3>
                        </div>
                        <div class="card-body p-2">
                            <div class="table-responsive px-2 pt-3">
                                <table id="tblData" class="table table-bordered table-sm" >
                                    <thead class="text-center">
                                        <tr>
                                            <th width="1%">Performance task <?php echo $rowgsheets['class_standing'];?>%</th>
                                            <th width="1%">Quizzes <?php echo $rowgsheets['quizzes'];?>%</th>
                                            <th width="1%">P.E <?php echo $rowgsheets['practical_exam'];?>%</th>
                                            <th width="1%">COMPUTATION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td contenteditable="true" class="edit bg-warning" data-id="<?php echo $rowgsheets['id'];?>" name="1"><?php echo $rowgsheets['class_standing'];?></td>
                                            <td contenteditable="true" class="edit bg-warning" data-id="<?php echo $rowgsheets['id'];?>" name="2"><?php echo $rowgsheets['quizzes'];?></td>
                                            <td contenteditable="true" class="edit bg-warning" data-id="<?php echo $rowgsheets['id'];?>" name="3"><?php echo $rowgsheets['practical_exam'];?></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table  class="table table-bordered table-sm" >
                                    <thead>
                                        <tr>
                                            <th colspan="7">Performance Task <?php echo $rowgsheets['class_standing'];?>%</th>
                                            <th colspan="7">Quizzes <?php echo $rowgsheets['quizzes'];?>%</th>
                                            <th colspan="3">Exam <?php echo $rowgsheets['practical_exam'];?>%</th>
                                            <th>P.T </th>
                                            <th>Q</th>
                                            <th>Wex</th>
                                        </tr>
                                    </thead>
                                    <thead>
                                        <tr>
                                            <th>1</th>
                                            <th>2</th>
                                            <th>3</th>
                                            <th>4</th>
                                            <th>5</th>
                                            <th>Total</th>
                                            <th>Equi</th>
                                            <th>1</th>
                                            <th>2</th>
                                            <th>3</th>
                                            <th>4</th>
                                            <th>5</th>
                                            <th>Total</th>
                                            <th>Equi</th>
                                            <th>1</th>
                                            <th>Total</th>
                                            <th>Equi</th>
                                            <th><?php echo $rowgsheets['class_standing'];?>%</th>
                                            <th><?php echo $rowgsheets['quizzes'];?>%</th>
                                            <th><?php echo $rowgsheets['practical_exam'];?>%</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $(document).on('blur', '.edit', function(){

    var id = $(this).data("id");
    var name = $(this).attr("name");
    var value = $(this).text();

    var action = "gradesheets";

    $.ajax({
    url:"action.php",
    method:"POST",
    data:{name:name,value:value,id:id,action:action},
    success:function(data)
    {
        toastr.success(data);
    }
    });
});
</script>