<?php
    session_start();
    
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'csavgsdb';

    $conn = mysqli_connect($host, $user, $pass,$db) or die(mysqli_error($conn));
?>