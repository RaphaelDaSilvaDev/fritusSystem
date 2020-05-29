<?php
    //Data Connection
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $db = "fritusdata";

    //Create Connection
    $conn = new mysqli($serverName, $userName, $password, $db);

    //Check Connection
    if($conn -> connect_error)
    {
        die("Connection Failed: " . $conn->connect_error);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fritus</title>
    <meta name="description" content="A Fritus Salgados é uma empresa que vende o melhor sabor para as suas festas!">
    <meta name="keywords" content="Fritus, Fritus Salgados, Salgados, Salgados para Festas, Festas, Fritus Festas">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Raphael Silva">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;600;800&display=swap" rel="stylesheet">
    <link rel="icon" href="img/FritusLogoYellow.png">
</head>
<body>
    
</body>
</html>