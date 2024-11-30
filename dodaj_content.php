<form action="dodaj.php" method="post" enctype='multipart/form-data'>
    <div class="input-article">Tytuł artykułu: <input type="text" name="title"></div>
    <div class="input-article">Treść artykułu: <textarea name="text" id="text"></textarea></div>
    <div class="input-article"><input type="file" multiple id="file" name="pliki[]"></div>

    <div class="input-article">Profil: <select name="section" id="select">
        <option value="1" <?php if(!$_SESSION['progperm']) echo 'disabled' ?>>Programista</option>
        <option value="2" <?php if(!$_SESSION['gastperm']) echo 'disabled' ?>>Gastronomia</option>
    </select>
</div>
    <button type="submit" id="btn">DODAJ</button>
</form>