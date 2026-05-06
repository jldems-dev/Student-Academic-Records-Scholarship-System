<?php
include "include/navigationheader.php"; 
include "time.php";

    $logs = mysqli_query($conn, "SELECT * FROM log WHERE userid = '$id' Order by date desc");
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <form method="post" action="logs.php">
                                <h4><i class="fas fa-list-alt"></i> Latest Activity Logs
                                <button type="submit" name="clear_log" class="clear_log btn btn-sm btn-danger float-right elevation-3"><i class="fas fa-trash-alt"></i> Clear</button>
                            </form>
                        </div>
                        <div class="card-body p-1">
                            <div class="table-responsive pt-3">
                                <table id="data_table"class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Date & Time</th>
                                            <th>Logs</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                   <tbody>
                                    <?php 
                                    $isempty = true;
                                    while($row = mysqli_fetch_array($logs)){ 
                                        $isempty = false;
                                        ?>
                                        <tr>
                                        <td><?php echo $row['date']; ?></td>
                                        <td><?php echo $row['activity']; ?></td>
                                        <td><?php echo Time_convert($row['date']); ?></td>
                                        </tr>
                                    <?php
                                    }if($isempty){
                                        echo "
                                            <tr>
                                            <td colspan='3' class ='text-center'>Empty Logs</td>
                                            </tr> 
                                            ";
                                    }
                                    ?>
                                    </tbody>
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
$(document).ready(function(){

$('#data_table').DataTable();

    $(document).on('click','.clear_log', function(){

        var action = "clear";

            $.ajax({
            url:"action.php",
            method:"POST",
            data:{action:action},
            success:function(data)
            {
            }
            });
    });
});
</script>