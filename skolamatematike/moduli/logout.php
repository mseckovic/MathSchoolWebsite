<?php
    session_start();// pocetak sessije
    session_destroy(); // unistavamo sessiju   
    header("location: pocetna.php"); 
?>

