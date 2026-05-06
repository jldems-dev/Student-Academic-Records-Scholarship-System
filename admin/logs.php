<?php
    include "include/navigationheader.php";
    include "time.php";
    $r = mysqli_query($conn, "SELECT * FROM log WHERE userid='$id' ORDER BY id DESC");
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <form method="post" action="logs.php">
                                <h4><i class="fas fa-list-alt"></i> Latest Activity Logs
                                <button type="submit"  class="clear_log btn btn-sm btn-danger float-right elevation-3" name="delete"><i class="fas fa-trash-alt"></i> Clear</button>
                            </form>
                        </div>
                        <div class="card-body p-1">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="table-responsive pt-3">
                                        <table id="data_table" class="table table-sm table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Date & Time</th>
                                                    <th scope="col">Logs</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                            $isempty = true;
                                            while($rowlogs = mysqli_fetch_array($r)){ 
                                                $isempty = false;
                                                ?>
                                                <tr>
                                                <td><?php echo $rowlogs['date']; ?></td>
                                                <td><?php echo $rowlogs['activity']; ?></td>
                                                <td><?php echo Time_Convert($rowlogs['date']);?></td>
                                                </tr>
                                            <?php
                                            }if($isempty){
                                                echo "
                                                    <tr>
                                                    <td colspan='10' class ='text-center'>Empty Logs</td>
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
            </div>
        </div>
    </section>
</div>
<script>

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
</script>