<?php session_start() ?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erasmus+ ZSTIB</title>
    <!--<link rel="stylesheet" href="style.css">-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/7e7c7245bf.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,800;1,100&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@600&family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="images/ikona.png">
</head> 
<body class="bg-basic">
    <?php 
        include 'includes/header.php';
    ?>

    <div id="content">
    <?php
        
        if(!isset($_GET['site']) || $_GET['site'] == 'glowna'){
            include 'includes/main_content.php';
        }
        else if($_GET['site'] == 'programista' || $_GET['site'] == 'gastronomia'){
            echo '<main>';
            include 'includes/artykuly.php';
            echo '</main>';
        }
    ?>
    </div>
</body>
</html>