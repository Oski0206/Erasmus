<?php session_start() ?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <link rel="icon" type="image/x-icon" href="images/ikona.png">   
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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
    <style>
        input{
            font-size: 24px;
        }
        button[type=submit]{
            font-size: 16px;
        }
        @media (max-width:800px){
            h1{
                font-size: 2.25rem;
            }
            h2{
                font-size: 2rem;
            }
        }
    </style>
</head> 
<body class="bg-basic">        
    <?php 
        include 'includes/header.php';
    ?>

    <div id="content" class="profile">
        <?php 
            $db = parse_ini_file('config.ini');
            if(isset($_SESSION['userid'])){
                $link = new mysqli($db['db_host'], $db['db_user'], $db['db_password'], $db['db_name']);

                $link -> set_charset('utf8');

                $query = "select * from ".$db['db_prefix']."uzytkownik where id ='".$_SESSION['userid']."';";
                $result = $link->query($query);
                $userdata = $result -> fetch_assoc();
                echo '<h1>'.$userdata['imie'].' '.$userdata['nazwisko'].'</h1>';
                echo '<p><strong>Login</strong>: '.$userdata['login'].'</p><br>';
                echo '<h2>Uprawnienia: </h2>';
                echo '<p><strong>Admin</strong>: <i>';
                echo (bool)$userdata['admin'] ? 'tak' : 'nie';
                echo '</i></p>';

                if(isset($_POST['pass']) && isset($_POST['newpass']) && isset($_POST['newpass2'])){
                    if(password_verify($_POST['pass'], $userdata['haslo'])){
                        if($_POST['newpass'] == $_POST['newpass2']){
                            $query = "UPDATE `".$db['db_prefix']."uzytkownik` SET `haslo` = ? WHERE `uzytkownik`.`id` = ?; ";
                            $stmt = $link -> prepare($query);
                            $hash = (string)password_hash($_POST['newpass'], PASSWORD_DEFAULT);
                            $stmt->bind_param("si", $hash, $_SESSION['userid']);
                            $stmt->execute();
                            echo 'POMYŚLNIE ZMIENIONO HASŁO';
                        }
                        else echo 'PODANE HASŁA NIE SĄ TAKIE SAME';
                    } 
                    else echo 'NIEPOPRAWNE HASŁO';
                }

                $link -> close();
            }
            if(isset($_SESSION['userid'])) require_once 'profil_content.php';
        ?>
        
    </div>
    
</body>
</html>