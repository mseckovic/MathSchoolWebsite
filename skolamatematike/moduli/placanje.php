<!DOCTYPE html>
<html lang="sr">

<head>

    <meta charset=utf-8>
    <meta name=description content="">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Matematika, Škola, Časovi, Učenici, Gaja" />
    <meta name=description content="Škola matematike sa 30 godišnjim iskustvom">

    <title>Gajina vesela škola matematike</title>

    <link rel="stylesheet" href="moduli/css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

</head>
<?php
include_once 'ucenik_class.php';
$object = new Ucenik();
echo $object->placanje_tabela();
$object-> cuvanjeXML();
?>
<script src="moduli/js/placanje.stranica.js"></script>