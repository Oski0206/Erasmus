<head>
<link rel="icon" type="image/x-icon" href="images/ikona.png">
</head>
<style>
    .article img{
        object-fit: cover;
        width: 20%;
        aspect-ratio: 1 / 1;
        cursor: pointer;
        transition-duration: .25s;
    }

    .article img:hover{
      filter: brightness(0.75);
    }

    .article h1{
        margin-left: 0px;
        font-size: 48px;
    }

    .article p{
      word-break: break-all;
      white-space: normal;
    }

    form{
        display: inline;
    }

    .delete-button{
        background-color: Transparent;
        background-repeat:no-repeat;
        border: none;    
        font-size: 16px;
    }

    .hidden-input{
        display: none
        
    }


    .row > .column {
    padding: 0 8px;
    }

    .row:after {
    content: "";
    display: table;
    clear: both;
    }

    .column {
    float: left;
    width: 25%;
    }

    .modal {
    display: none;
    position: fixed;
    z-index: 1;
    padding-top: 100px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.75);
    }

    .modal-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    width: 60%;
    max-width: 1200px;
    }

    .close {
    color: white;
    position: absolute;
    top: 85px;
    right: 25px;
    font-size: 35px;
    font-weight: bold;
    z-index: 20;
    }

    .close:hover,
    .close:focus {
    color: #999;
    text-decoration: none;
    cursor: pointer;
    }

    .mySlides {
    display: none;
    }

    .prev,
    .next {
    cursor: pointer;
    position: absolute;
    top: 50%;
    width: auto;
    padding: 16px;
    margin-top: -50px;
    color: white;
    font-weight: bold;
    font-size: 20px;
    transition: 0.6s ease;
    border-radius: 0 3px 3px 0;
    user-select: none;
    -webkit-user-select: none;
    }

    .next {
    right: 0;
    border-radius: 3px 0 0 3px;
    }

    .prev:hover,
    .next:hover {
    background-color: rgba(0, 0, 0, 0.8);
    }

    img.demo {
    opacity: 0.6;
    }

    .active,
    .demo:hover {
    opacity: 1;
    }

    img.hover-shadow {
    transition: 0.3s;
    }

    .hover-shadow:hover {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    @media (max-width:800px){
      .close{
        top: 100px;
      }
      .modal-content{
        width: 100%;
      }
      .article img{
        width: 33.333%;
      }
    }
</style>

<div id="modal-img" class="modal">
  <span class="close cursor" onclick="closeModal()">&times;</span>
  <div class="modal-content" style="background-color: rgba(0, 0, 0, 0)">
    <div id="slide">
      <img src="upload/19/0.jpg" style="width:100%">
    </div>
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
  </div>
</div>

<?php
    $db = parse_ini_file('config.ini');
    $link = new mysqli($db['db_host'], $db['db_user'], $db['db_password'], $db['db_name']);

    $link -> set_charset('utf8');


    //tutaj sie dodaje site to nazwa strony w bazie a id to jej id
    if (isset($_GET['site'])) {
      if ($_GET['site'] === "programista") {
          $section_id = '1'; // Sekcja dla programisty
      } 
      elseif ($_GET['site'] === "gastronomia") {
          $section_id = '2'; // Sekcja dla gastronomii
      } 
      elseif ($_GET['site'] === "chuj wie") {
        $section_id = '3'; // Sekcja dla chuj wie
      } 
      elseif ($_GET['site'] === "programisci i informatycy") {
        $section_id = '4'; // Sekcja programistow i informatykow
      } else {
          $section_id = null; // Nieznana sekcja
          echo '<p>Nieznana sekcja: ' . htmlspecialchars($_GET['site']) . '</p>';
      }
  } else {
      $section_id = null; // Brak parametru 'site'
      echo '<p>Brak wybranej sekcji</p>';
  }
    if(isset($_POST['delete'])){
        //$link -> query('DELETE FROM artykuly WHERE id ='.$_POST['delete'].'');
    }

    if(isset($_POST['delete'])){
      $user = $link->query("select * from ".$db['db_prefix']."uzytkownik where id = ".$_SESSION['userid'])->fetch_assoc();
      if($user['admin']){
        $query = 'delete from '.$db['db_prefix'].'artykuly where id = ?';
        $stmt = $link -> prepare($query);
        $stmt -> bind_param('i', $_POST['delete']);
        $stmt -> execute();
      }
      else echo 'Nie masz uprawnień stary';
    }

    $query = "select * from ".$db['db_prefix']."artykuly where sekcja ='".$section_id."' ORDER BY `id` DESC;";
    $result = $link->query($query);

    if(!$result) echo '<p>Brak postów do wyświetlenia</p>';
    

    if(isset($_SESSION['userid'])) $adminPerms = $link->query('select admin from '.$db['db_prefix'].'uzytkownik where id = '.$_SESSION['userid'].';')->fetch_assoc()['admin'];

    if($result){
      while($wiersz=$result->fetch_assoc()){
          echo '<div class="article" id="id'.$wiersz['id'].'">';
          echo '<h1 id="title">'.$wiersz['nazwa'].'</h1>';
          $paragraphs = explode("\r\n", $wiersz['tresc']);

          for($i = 0; $i < count($paragraphs); $i++) echo '<p>'.$paragraphs[$i].'</p>';
          
          if(is_dir('upload/'.$wiersz['id'])){
              $fileArray = scandir('upload/'.$wiersz['id']);
              for($i = 0; $i < count($fileArray)-2; $i++) echo '<img src = "upload/'.$wiersz['id'].'/'.$fileArray[2+$i].'" onclick="openModal();currentSlide('.$wiersz['id'].', '.$i.')">';
          }
          echo '<br>';
          if(!$wiersz['autor_anon']){
            $author = $link->query('select imie, nazwisko from '.$db['db_prefix'].'uzytkownik where id = '.$wiersz['autor'].';')->fetch_assoc();
            echo '<i>Autor: '.$author['imie'].' '.$author['nazwisko'].'</i>';
          }
          
          if(isset($_SESSION['userid'])) if($_SESSION['userid'] == $wiersz['autor'] || $adminPerms) {
              echo ' &nbsp;<form class="delete-form" action="index.php';
              if(isset($_GET['dm'])) echo '?dm=on&site='.$_GET['site'];
              else echo '?site='.$_GET['site'];
              echo '" method="post">';
              echo '<input type="text" class="hidden-input" name="delete" value='.$wiersz['id'].'>';
              echo '<button type="submit" class="delete-button" style="color: var(--text-col)"><i class="fa-solid fa-trash"></i></button>';
              echo '</form>';
          }
          echo '</div>';
          echo '<hr>';
      }
    }

    $link -> close();
?>

<script>
        let currentArticle = 0;
        let currentIndex = 0;
        let slideNumbers;

        function currentSlide(article, slideIndex){
            currentArticle = article;
            currentIndex = slideIndex;

            let slideImg = document.querySelector('#slide img');
            slideImg.src = 'upload/' + article + '/' + slideIndex + ".jpg";
        }

        function plusSlides(amount){
            let selector = '#id' + currentArticle + ' img';
            console.log(parseInt(document.querySelectorAll(selector).length));
            if(currentIndex + amount < 0 ) currentSlide(currentArticle, document.querySelectorAll(selector).length-1);
            else if(document.querySelectorAll(selector).length > currentIndex+amount) currentSlide(currentArticle, currentIndex+amount);
            else currentSlide(currentArticle, 0);
        }

        function openModal(){
            let modal = document.querySelector('#modal-img');
            let slide = document.querySelector('#slide');

            modal.style.display = 'block';
            slide.style.display = 'block';
        }

        function closeModal(){
            let modal = document.querySelector('#modal-img');
            modal.style.display = 'none';
        }
</script>


