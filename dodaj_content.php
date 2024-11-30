<form action="dodaj.php" method="post" enctype='multipart/form-data'>
    <div class="input-article">Tytuł artykułu: <input type="text" name="title"></div>
    <div class="input-article">Treść artykułu: <textarea name="text" id="text"></textarea></div>
    <div class="input-article"><input type="file" multiple id="file" name="pliki[]"></div>

    
    <div class="input-article">Profil: <select name="section" id="select">
        <?php
        $db = parse_ini_file('config.ini');
        $link = new mysqli($db['db_host'], $db['db_user'], $db['db_password'], $db['db_name']);
        $query = "SELECT id, nazwa, rok FROM er_sekcja";
        $result = $link->query($query);
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Wyświetlenie opcji w formacie "nazwa + (rok)"
                echo "<option value='" . htmlspecialchars($row['id']) . "'>" . 
                     htmlspecialchars($row['nazwa']) . " (" . htmlspecialchars($row['rok']) . ")</option>\n";
            }
        } else {
            echo "Brak danych do wyświetlenia.";
        }
        ?>





        <!-- <option value="1" <?php if(!$_SESSION['progperm']) echo 'disabled' ?>>Programista</option>
        <option value="2" <?php if(!$_SESSION['gastperm']) echo 'disabled' ?>>Gastronomia</option> -->
    </select>
</div>
    <button type="submit" id="btn">DODAJ</button>
</form>