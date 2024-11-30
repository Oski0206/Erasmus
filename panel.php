<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <link rel="icon" type="image/x-icon" href="images/ikona.png">   
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,800;1,100&display=swap" rel="stylesheet">
    <style>
        :root{
            --bg-col: <?php if(!isset($_GET['dm'])) echo '#E5F6FF'; else echo '#425159'; ?>;
            --text-col:  <?php if(!isset($_GET['dm'])) echo 'black'; else echo 'white'; ?>;
        }
        *{
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-size: 30px;
            font-family: 'Poppins';
            color: var(--text-col);
        }
        body{
            background-color: var(--bg-col);
        }
        a{
            color: rgb(120, 120, 200);
        }
        #content{
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>
<body>
    <div id="content">
    <?php
    
        require_once 'login_verification.php';
        
        if((isset($_POST['login'])) && loginVerification($_POST['login'], $_POST['password'])) {
            echo '<p>Pomyślnie zalogowano jako <b>'.$_POST['login'].'</b></p>';
            echo '<a href="index.php';
            if(isset($_GET['dm'])) echo '?dm=on';
            echo'">Powrót do strony głównej</a>';
        }
        else{
            echo '<p>Podano niepoprawne dane podczas logowania!</p>';
            echo '<a href="login.php';
            if(isset($_GET['dm'])) echo '?dm=on';
            echo'">Powrót do strony logowania</a>';
        }
    ?>
    </div>
</body>
</html>