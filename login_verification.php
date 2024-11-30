<?php
    function loginVerification($login, $password){
        $db = parse_ini_file('config.ini');
        $link = new mysqli($db['db_host'], $db['db_user'], $db['db_password'], $db['db_name']);

        $link -> set_charset('utf8');

        $stmt = $link -> prepare("select id, login, haslo from ".$db['db_prefix']."uzytkownik WHERE login = ?");
        $stmt -> bind_param('s', $login);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result){
            while($wiersz=$result->fetch_assoc()){
                if($wiersz['login'] != $login) continue;
                if(!password_verify($password, $wiersz['haslo'])) continue;

                $_SESSION['userid'] = $wiersz['id']; 
                $link -> close();

                return true;
            }
        }

        $link -> close();
        return false;
    }
?>