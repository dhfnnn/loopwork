<?php 
    require "utility/UtilityLoader.php";
    use Utility\Utility AS utl;
    $utl = new utl();
    echo $utl->mnr("SELECT * FROM users");
?>