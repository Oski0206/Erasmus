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
            if(isset($_SESSION['userid'])) {
                $link = new mysqli($db['db_host'], $db['db_user'], $db['db_password'], $db['db_name']);
                $link->set_charset('utf8');
                if ($link->connect_error) {
                    die("Błąd połączenia: " . $link->connect_error);
                }

                $query = "SELECT * FROM " . $db['db_prefix'] . "uzytkownik WHERE id = ?";
                $stmt = $link->prepare($query);
                $stmt->bind_param("i", $_SESSION['userid']);
                $stmt->execute();
                $result = $stmt->get_result();
                $userdata = $result->fetch_assoc();
                $stmt->close();

                if ($userdata) {
                    echo '<h1>' . htmlspecialchars($userdata['imie']) . ' ' . htmlspecialchars($userdata['nazwisko']) . '</h1>';
                    echo '<p><strong>Login</strong>: ' . htmlspecialchars($userdata['login']) . '</p><br>';
                    echo '<h2>Uprawnienia: </h2>';
                    echo '<p><strong>Admin</strong>: <i>' . ((bool)$userdata['admin'] ? 'tak' : 'nie') . '</i></p>';
                    if ((bool)$userdata['admin']) {
                        echo '<p><strong><a style="color: black" href="panel_administracyjny.php">Panel Administracyjny</a></strong></p>';
                    }
                }

                if(isset($_POST['pass'], $_POST['newpass'], $_POST['newpass2'])) {
                    if(password_verify($_POST['pass'], $userdata['haslo'])) {
                        if($_POST['newpass'] === $_POST['newpass2']) {
                            $query = "UPDATE `" . $db['db_prefix'] . "uzytkownik` SET `haslo` = ? WHERE `id` = ?";
                            $stmt = $link->prepare($query);
                            $hash = password_hash($_POST['newpass'], PASSWORD_DEFAULT);
                            $stmt->bind_param("si", $hash, $_SESSION['userid']);
                            if ($stmt->execute()) {
                                echo '<p class="success">POMYŚLNIE ZMIENIONO HASŁO</p>';
                            } else {
                                echo '<p class="error">Błąd podczas zmiany hasła: ' . $stmt->error . '</p>';
                            }
                            $stmt->close();
                        } else {
                            echo '<p class="error">PODANE HASŁA NIE SĄ TAKIE SAME</p>';
                        }
                    } else {
                        echo '<p class="error">NIEPOPRAWNE HASŁO</p>';
                    }
                }
                
                $link->close();
            }
            if(isset($_SESSION['userid'])) require_once 'profil_content.php';
        ?>
        
    </div>
    
</body>
</html>
