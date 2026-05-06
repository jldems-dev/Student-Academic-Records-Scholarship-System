<?php
if(isset($_SESSION['stats']) != '' && isset($_SESSION['icon']) != '' && isset($_SESSION['message']) != ''){
    $status = $_SESSION['stats'];
?>
<div class="alert alert-<?php echo $_SESSION['stats'];?> alert-dismissible align-items-center" >
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <i class="icon fas fa-<?php echo $_SESSION['icon'];?>"></i> <?php echo $_SESSION['message'];?>
</div>
<?php
unset($_SESSION['stats']);
    }
?>