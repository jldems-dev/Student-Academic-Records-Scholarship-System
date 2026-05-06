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
                        <h1><i class="fas fa-bell"></i> Logs
                        <ol class="breadcrumb float-sm-right" style="font-size:18px;">
                            <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item active">Logs</li>
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
                            <form method="post" action="logs.php">
                                <h4><i class="fas fa-list-alt"></i> Latest Activity Logs
                                <button type="submit" data-id="<?php echo $newid;?>" class="clear_log btn btn-sm btn-danger float-right elevation-3" name="delete"><i class="fas fa-trash-alt"></i> Clear</button>
                            </form>
                        </div>
                        <div class="card-body p-1">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="table-responsive pt-3">
                                        <table id="log_table" class="table table-sm table-striped table-bordered">
                                            <thead>
                                                <th scope="col">Date & Time</th>
                                                <th scope="col">Logs</th>
                                                <th scope="col">Status</th>
                                            </thead>
                                            <?php
                                                $isempty = true;
                                                while($row = mysqli_fetch_assoc($querylog)){
                                                    $isempty = false;
                                            ?> 
                                            <tbody>
                                                <tr>
                                                <td><?php echo $row['date']; ?></td>
                                                <td><?php echo $row['activity']; ?></td>
                                                <td><?php echo Time_Convert($row['date']); ?></td>
                                                </tr>
                                            </tbody>
                                            <?php
                                            }if($isempty){
                                                echo "
                                                    <tr>
                                                    <td colspan='3' class ='text-center'>Empty Logs</td>
                                                    </tr> 
                                                    ";
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
$(document).ready(function(){

$('#log_table').DataTable();
    $(document).on('click','.clear_log', function(){

        var teacherid = $(this).data("id");

        var action = "clear";

        if(confirm("Are you sure you want to Clear Logs?")){
        $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action,teacherid:teacherid},
        success:function(data){}
        });
        }
    });
});
</script>