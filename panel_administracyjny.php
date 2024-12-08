<?php 
session_start();

// Włącz buforowanie wyjścia
ob_start();
?>

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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
    <style>
        tr, th, td{
            width: 20vh;
            border: 1px solid black;
            margin: 0px;
            text-align: center;
        }
        table{
            border-spacing: 0px;
        }

        @media (max-width:800px){
            
        }
    </style>
</head> 
<body class="bg-basic">        
    <?php 
        include 'includes/header.php';

        $db = parse_ini_file('config.ini');

        function adminCheck(){
            $db = parse_ini_file('config.ini');
            if(!isset($_SESSION['userid'])) return false;
            $link = new mysqli($db['db_host'], $db['db_user'], $db['db_password'], $db['db_name']);
            $link -> set_charset('utf8');
            $adminPerm = $link->query('select admin from '.$db['db_prefix'].'uzytkownik where id = '.$_SESSION['userid'].';')->fetch_assoc()['admin'];
            if($adminPerm) return true;
            $link -> close();
            return false;
        }

        if(!adminCheck()){
            echo 'nie jesteś adminem';
        }
        else {
            if(isset($_POST['login']) && isset($_POST['imie']) && isset($_POST['nazwisko']) && isset($_POST['haslo'])){
                $link = new mysqli($db['db_host'], $db['db_user'], $db['db_password'], $db['db_name']);
                $link -> set_charset('utf8');

                $query = "INSERT INTO `".$db['db_prefix']."uzytkownik` (`id`, `login`, `haslo`, `imie`, `nazwisko`, `admin`) VALUES (NULL, ?, ?, ?, ?, ?)";
                $stmt = $link -> prepare($query);
                $hash = (string)password_hash($_POST['haslo'], PASSWORD_DEFAULT);
                $admin = isset($_POST['admin']);
                $stmt->bind_param("ssssi", $_POST['login'], $hash, $_POST['imie'], $_POST['nazwisko'], $admin);
                $stmt->execute();
                $link -> close();
                
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Sprawdzenie danych
                if (isset($_POST['sekcja']) && isset($_POST['rok'])) {
                    $sekcja = trim($_POST['sekcja']);
                    $rok = trim($_POST['rok']);

                    // Walidacja danych
                    if (empty($sekcja) || !preg_match('/^\d{4}$/', $rok) || $rok < 1901 || $rok > 2155) {
                        die("Błąd: Wprowadź poprawne dane. Rok musi być w zakresie 1901–2155.");
                    }

                    // Połączenie z bazą danych
                    $link = new mysqli($db['db_host'], $db['db_user'], $db['db_password'], $db['db_name']);
                    $link->set_charset('utf8');

                    if ($link->connect_error) {
                        die("Błąd połączenia: " . $link->connect_error);
                    }

                    // Przygotowanie zapytania
                    $query = "INSERT INTO `" . $db['db_prefix'] . "sekcja` (`id`, `nazwa`, `rok`) VALUES (NULL, ?, ?)";
                    $stmt = $link->prepare($query);

                    if (!$stmt) {
                        die("Błąd w zapytaniu SQL: " . $link->error);
                    }

                    // Bindowanie i wykonanie zapytania
                    $stmt->bind_param("ss", $sekcja, $rok);
                    $stmt->execute();

                    if ($stmt->error) {
                        die("Błąd podczas wykonywania zapytania: " . $stmt->error);
                    }

                    $stmt->close();
                    $link->close();

                    // PRG: Przekierowanie po udanym zapisie
                    header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
                    exit;
                } else {
                    echo "Proszę uzupełnić wszystkie pola formularza.";
                }
            }

            // Wyświetlenie komunikatu po przekierowaniu
            if (isset($_GET['success']) && $_GET['success'] == 1) {
                echo "Dane zostały zapisane.";
            }

            echo '<div id="content">';
            echo '<h1>UŻYTKOWNICY</h1>';
            echo '<form action="panel_administracyjny.php" method="post">';
            echo '<table>';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Login</th>';
            echo '<th>Imie</th>';
            echo '<th>Nazwisko</th>';
            echo '<th>Admin</th>';
            echo '</tr>';
            $link = new mysqli($db['db_host'], $db['db_user'], $db['db_password'], $db['db_name']);
            $link -> set_charset('utf8');
            $result = $link -> query('select * from '.$db['db_prefix'].'uzytkownik');
            while($wiersz=$result->fetch_array()){
                echo '<tr>';
                echo '<td>'.$wiersz['id'].'</td>';
                echo '<td>'.$wiersz['login'].'</td>';
                echo '<td>'.$wiersz['imie'].'</td>';
                echo '<td>'.$wiersz['nazwisko'].'</td>';
                echo '<td>'.$wiersz['admin'].'</td>';
                echo '</tr>';
            }
            $link -> close();
            echo '<tr>';
            echo '<td><input type="text" name="haslo" placeholder="haslo"></td>';
            echo '<td><input name="login" type="text"></td>';
            echo '<td><input name="imie" type="text"></td>';
            echo '<td><input name="nazwisko" type="text"></td>';
            echo '<td><input name ="admin" type="checkbox"> <button type="submit">dodaj</button></td>';
            echo '</tr>';
                
            echo '</table>';
            echo '</form>';
            echo '</div>';

            echo'<form action="panel_administracyjny.php" method="post">
            <div>
            <input type="text" name="sekcja" placeholder="Sekcja">
            <input type="number" name="rok" placeholder="Rok" min="1900" max="2100">
            <button type="submit">Dodaj sekcje</button>
            </div></form>';
        }
    ?>
    
</body>
</html>
