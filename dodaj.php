<?php
    session_start();
?>
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
</head> 
<body class="bg-basic">
    <?php 
        include 'includes/header.php';
    ?>
    <style>
        form, input[type=text], button[type=submit], option, select{
            font-size: 1.1em;
        }
        form{
            height: 500px;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: center;
            width: 80%;
        }
        .input-article{
            margin-top: 5px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
        }
        #text{
            height: 300px;
            width: 100%;
        }
        #btn{
            padding: 10px;
            margin-bottom: -30px;
            background-color: #425159;
            border: none;
            border-radius: 5px;
            color: white;
        }
        #btn:hover{
            background-color: #689EA5;
        }
    </style>

    <div id="content">

    <?php 
        $db = parse_ini_file('config.ini');
        if(isset($_POST['title']) && isset($_POST['text']) && isset($_POST['section']) && isset($_SESSION['userid'])){
            $link = new mysqli($db['db_host'], $db['db_user'], $db['db_password'], $db['db_name']);

            $link -> set_charset('utf8');

            $query = "INSERT INTO `".$db['db_prefix']."artykuly` (`nazwa`, `tresc`, `autor`, `sekcja`) VALUES (?, ?, ?, ?);";
            $stmt = $link -> prepare($query);
            $stmt->bind_param("ssii", $_POST['title'], $_POST['text'], $_SESSION['userid'], $_POST['section']);
            $stmt->execute();

            $result = $link -> query('SELECT id FROM '.$db['db_prefix'].'artykuly ORDER BY id DESC LIMIT 1');            

            $wiersz = $result -> fetch_assoc();
            $artId = $wiersz['id'];


            if(count($_FILES['pliki']['name']) > 0){
                $countfiles = count($_FILES['pliki']['name']);
            
                for($i=0;$i<$countfiles;$i++){
                    $filename = $_FILES['pliki']['name'][$i];
                
                    if(!is_dir('upload/'.$artId)) mkdir('upload/'.$artId);
                    move_uploaded_file($_FILES['pliki']['tmp_name'][$i],'upload/'.$artId.'/'.$i.'.jpg');
             
                }
            }
            echo 'Post pomyślnie dodano';
            $link -> close();
        }
    ?>

    <?php
        if(isset($_SESSION['userid'])) require_once 'dodaj_content.php';
    ?>

    </div>
    
</body>
</html>