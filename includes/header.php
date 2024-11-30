<style>
    :root {
        --bg-col-lm: #E5F6FF;
        --bg-col-dm: #425159;

        --bg-col: #E5F6FF;
        --text-col: black;
        --main-col: #689EA5;
        --main-col-light: #87b8bf;
        --main-col-hover: #4a6981;

        --header-col: #4a6981;
    }

    *{ 
        padding: 0px;
        margin: 0px;
        box-sizing: border-box;
    }

    
    header button{
        font-size: 5vh;
        border: none;
        background-color: var(--main-col);
    }


    body{
        display: flex;
        flex-direction: column;

        align-items: center;
    }

    img{
        max-width: 100%;
    }

    .bg-basic{ background-color: var(--bg-col); color: var(--text-col)}
    .bg-main{ background-color: var(--main-col); }
    .chosen-color{ background-color: var(--main-col-light); }

    .sticky{
        position: fixed;
        top: 0px;
        width: 100%;
    }

    header{
        height: 75px;
        box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.574);
        z-index: 20;
    }

    header form{
        display: inline;
        width: 100%;
    }

    

    #header-content-desktop{
        left: 50%;
        transform: translateX(-50%);
        position: fixed;
        max-width: 90%;
        width: 1200px;
        display: flex;
        justify-content: space-around;
        align-items: center;
    }

    a{
        cursor: pointer;
        color: white;
        text-decoration: none;
    }

    #header-content-desktop a:hover{
        text-shadow: 0px 0px 5px var(--main-col-hover);
    }

    #desktop-buttons{
        display: flex;
        flex: 0.75;
    }

    #desktop-buttons a{
        flex: 1 1 0;
        text-align: center;
    }

    header form img{
        margin: 7px;
        margin-left: 7vh;
        height: 61px;

        vertical-align: middle;
    }

    #desktop-menu{
        border-left: 2px solid white;

        float: right;
        display: flex;

        justify-content: space-around;

        width: 50%;
    }

    .poppins{
        font-family: 'Poppins', sans-serif;
    }

    #desktop-menu button{
        height: 100%;
        border: none;

        font-size: 20px;
        text-decoration: none;
        color: white;

        text-align: center;
        line-height: 75px;
        flex: auto 1;
        transition-duration: .1s;
    }

    #desktop-menu button:hover{
        background-color: var(--main-col-hover);
        letter-spacing: 3px;
    }

    #content{
        display: flex; 
        flex-direction:column;
        align-items: center;

        width: 1200px;
        max-width: 90%;
        padding-top: 75px;
        font-family: 'Source Sans Pro', sans-serif;

    }

    main{
        width: 100%;
        font-size: 20px;

        display: flex;
        flex-direction: column;
    }

    blockquote{
        padding-left: 2.5%;
        border-left: 5px solid var(--main-col);
        font-style: italic;
    }

    ul, ol{
        padding-left: 5%;
    }

    ol > li::marker {
        font-weight: bold;
    }

    .profile{
        font-size: 32px;
    }

    main h1{
        font-size: 32px;
        font-weight: 800;
    }

    main h2{
        margin-top: 15px;
    }

    h1, h2{
        font-family: 'Oswald', sans-serif;
        color: var(--header-col);
    }

    #main-text{
        display: flex; 
        flex-direction: row;
    }

    main p{
        margin: 10px 0px;
    }

    input[type=text]{
        border-radius: 2px;
    }

    .link{
        color: var(--text-col);
        text-decoration: underline;
    }

    footer > hr{
        background-color: var(--main-col-hover);
        height: 3px;
        margin: 5px 0px;
    }

    footer{
        text-align: right;
        width: 100%;
    }

    button:hover{
        cursor: pointer;
    }

    .mobile-display{display:none}

    .desktop-display{display:block}
    
    #mobile-content-divider{
        display: none;
    }

    @media (min-width:800px){
        .dark-mode-checkbox{
            transform: translateY(0%);
        }
    } 

    @media (max-width:800px){
        .desktop-display {display:none}
        .mobile-display {display:block}
        #header-content-desktop {display:none}

        #mobile-content-divider{
            display: block;
        }

        header{
            height: 10vh;
            min-height: 48px;
            box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.411);
        }

        #header-content-mobile{
            line-height: 9vh;
            color: white;
        }

        .dark-mode-checkbox{
            transform: translateY(50%);
        }

        /* #header-content-mobile a{
            margin-left: 10px;
            transform: translateY(50%);
        } */

        #header-content-mobile #main-page-button{
            color: white; font-size: min(24px, 9vh); transform: translateY(4px);
        }

        #mobile-header-bg{
            position: fixed;
            top: 0px;
            left: 0px;
            width: 100%;
            height: 10vh;
            min-height: 48px;
            background-color: var(--main-col);
        }

        #coll-checkbox{
            -webkit-appearance: none;
            appearance: none;
            visibility: none;
        }

        #mobile-collapsible{
            font-size: 24px;
            width: 24px;
            right: 10px;
            top: 4.5vh;
            transform:translateY(-45%);
            position: absolute;
            vertical-align: bottom;
            display: inline;

            z-index: 20;
        }

        #mobile-menu{
            transform: translateY(-60vh);
            width: 100%;
            transition-duration: .25s;

            z-index: -100;
            position: absolute;
            color: var(--main-col);
        }

        #coll-checkbox:checked ~ #mobile-menu{
            transform: translateY(2.75vh);
        }

        


        
        

        #mobile-menu button, #mobile-menu a{
            margin: 0px;
            text-align: center;
            display: block;
            margin-top: -20px;
            height: calc((60vh + 2.5vh)/5);
            width: 100%;
            color: white;
            display: block;

            background-color: var(--main-col);

            font-size: 5vh;
            font-family: 'Roboto', sans-serif;

            border: none;
        }

        #mobile-menu button:active, .mobile-menu-link:active{
            background-color: var(--main-col-hover);
        }

        #content{
            width: 100%;
            padding-top: 11vh;
        }

        main{
            padding: 10px;
        }

        main h1{
            margin: 5px;
        }

        #main-text{
            flex-direction: column;
        }
    }





    .dark-mode-checkbox{
        -webkit-appearance: none;
        appearance: none;
        visibility: none;

        box-shadow: inset 0px 2px 6px rgba(0, 0, 0, 0.197), inset 0px -2px 6px rgba(113, 113, 113, 0.203);

        width: 40px;
        height: 20px;

        cursor: pointer;

        background-color: var(--bg-col-lm);

        border-radius: 10px;
    }

    .dark-mode-checkbox:after{
        content: "";
        width: 18px;
        height: 18px;
        position: absolute;
        top: 1px;
        left: 1px;

        background-color: var(--bg-col-dm);

        border-radius: 9px;

        transition: ease-in .1s;
    }


    .dark-mode-checkbox:checked::after{
        left: 39px;
        transform: translateX(-100%);
    }
</style>


<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        let r = document.querySelector(':root');
        let dmCheck = document.querySelectorAll('input[name="dm"]');
        let light = dmCheck[0].checked;
        colorMode();

        for(let i = 0; i < dmCheck.length; i++){
            dmCheck[i].addEventListener('change', (event) => {
                colorMode();
                otherCheck = (i == 0) ? 1 : 0;
                if (dmCheck[i].checked) dmCheck[otherCheck].checked = true;
                else dmCheck[otherCheck].checked = false;
            });
        }

        function colorMode(){
            if(light){
                r.style.setProperty('--bg-col', '#425159');
                r.style.setProperty('--text-col', '#E5F6FF');
                r.style.setProperty('--header-col', '#689EA5')
                light = false;
            }
            else{
                r.style.setProperty('--bg-col', '#E5F6FF');
                r.style.setProperty('--text-col', 'black');
                r.style.setProperty('--header-col', '#4a6981');
                light = true;
            }
            
        }

        //!!! PRZENIEŚĆ TO DO 'header.php'
    });
    
</script>


<header class="sticky bg-main"> 
    <form action="index.php" method="get">
    <div id="header-content-desktop" class="desktop-display">
        <button type="submit" name="site" value="glowna"><img src="images/logo.png" alt=""></button>
        <input type="checkbox" onclick="ChangeHref(event)" style="margin-right: 20px" <?php if(isset($_GET['dm'])) echo 'checked'?> name="dm" class="dark-mode-checkbox"> <span id="background" class="bg-light"></span>
        <div id="desktop-buttons">
            
            <?php if(isset($_SESSION['userid'])) echo '<a id="profile-button" href="profil.php"><i style="font-size: 20px; vertical-align: middle;" class="fa-solid fa-user"></i></a>
            <a id="add-button" href="dodaj.php"><i style="font-size: 20px; vertical-align: middle;" class="fa-solid fa-pen-nib"></i></a>
            <a id="login-button" href="logout.php"><i style="font-size: 20px; vertical-align: middle;" class="fa-sharp fa-solid fa-right-to-bracket"></i></a>';
                    else echo '<a id="login-button" href="login.php"><i style="font-size: 20px; vertical-align: middle;" class="fa-sharp fa-solid fa-right-to-bracket"></i></a>'?>
        </div>


        <?php
// Ładowanie konfiguracji bazy danych
$db = parse_ini_file('config.ini');

// Połączenie z bazą danych
$link = new mysqli($db['db_host'], $db['db_user'], $db['db_password'], $db['db_name']);

// Sprawdzenie połączenia
if ($link->connect_error) {
    die("Błąd połączenia: " . $link->connect_error);
}

// Zapytanie SQL, aby pobrać dane
$query = "SELECT nazwa FROM er_sekcja"; // Zamień 'your_table_name' na swoją tabelę
$result = $link->query($query);

// Aktualnie wybrana strona
$currentSite = isset($_GET['site']) ? $_GET['site'] : '';

// Generowanie selektora
echo "<div id='desktop-menu'>\n";
echo "<select id='siteSelector' name='site'>\n";
echo "<option value=''>-- Wybierz opcję --</option>\n"; // Opcja domyślna

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Użycie strtolower do zamiany na małe litery
        $value = strtolower($row['nazwa']);
        $selected = ($value === $currentSite) ? 'selected' : '';
        echo "<option value='" . htmlspecialchars($value) . "' $selected>" . 
             htmlspecialchars($row['nazwa']) . "</option>\n";
    }
}

echo "</select>\n";
echo "</div>\n";

// Zamknięcie połączenia
$link->close();
?>

<script>
// Obsługa zdarzenia zmiany w selektorze
document.getElementById('siteSelector').addEventListener('change', function() {
    var selectedValue = this.value;
    if (selectedValue) {
        // Przekierowanie na stronę z parametrem `site`
        window.location.href = "index.php?site=" + encodeURIComponent(selectedValue);
    }
});
</script>









            
        <!-- <div action="index.php" method="get" id="desktop-menu">
            <button type="submit" class="poppins <?php if(isset($_GET['site'])) if($_GET['site'] == 'programista') echo 'chosen-color'?>" name="site" value="programista"><i class="fa fa-desktop" style="font-size: 20px;"></i> Programista</a>
            <button type="submit" class="poppins <?php if(isset($_GET['site'])) if($_GET['site'] == 'gastronomia') echo 'chosen-color'?>" name="site" value="gastronom"><i class="fa-solid fa-utensils" style="font-size: 20px;"></i> Gastronomia</a>
        </div> -->
    </div>
    </form action="index.php" method="get">
        <div id="header-content-mobile" class="mobile-display">
            <div id="mobile-header-bg"></div>
            <form action="index.php" method>
            <button id="main-page-button" type="submit" name="site" value="glowna" style="margin-left: 10px"><i class="fa-solid fa-house" style="color: white; font-size: 24px; transform: translateY(4px)"></button></i></a>
            <input type="checkbox" <?php if(isset($_GET['dm'])) echo 'checked'?> name="dm" class="dark-mode-checkbox"> <span id="background" class="bg-light"></span>
            <input type="checkbox" id="coll-checkbox"> <label style="z-index: 20" for="coll-checkbox" id="mobile-collapsible"><i class="fa-solid fa-bars"></i></label>
            
            <div id="mobile-menu">
                <button type="submit" class="poppins <?php if(isset($_GET['site'])) if($_GET['site'] == 'programista') echo 'chosen-color'?>" name="site" value="programista"><i class="fa fa-desktop" style="font-size: 20px;"></i> Programista</button>
                <button type="submit" class="poppins <?php if(isset($_GET['site'])) if($_GET['site'] == 'gastronomia') echo 'chosen-color'?>" name="site" value="gastronom" style="margin-top: -1px"><i class="fa-solid fa-utensils" style="font-size: 20px;"></i> Gastronomia</button>
                <a class="mobile-menu-link" href="login.php" class="poppins" style="margin-top: -1px"><i class="fa-sharp fa-solid fa-right-to-bracket" style="font-size: 20px;"></i> Zaloguj się</a>
                <?php 
                    if(isset($_SESSION['userid'])) echo '<a class="mobile-menu-link" href="profil.php" class="poppins" style="margin-top: -1px"><i class="fa-solid fa-user" style="font-size: 20px;"></i> Profil</a>';
                    if(isset($_SESSION['userid'])) echo '<a class="mobile-menu-link" href="dodaj.php" class="poppins" style="margin-top: -1px"><i class="fa-solid fa-pen-nib" style="font-size: 20px;"></i> Dodaj artykuł</a>'; 
                ?>
            </div>
            </div>
    </form>

    
    <script>
        function ChangeHref(event){
            let checkbox = event.currentTarget;
            let hrefs = document.querySelectorAll('#desktop-buttons a, #mobile-menu a');
            let deleteForms = document.querySelectorAll(".delete-form");
            for(let i = 0; i < hrefs.length; i++){
                if(checkbox.checked) hrefs[i].href = hrefs[i].href.replace(".php", ".php?dm=on");
                else hrefs[i].href = hrefs[i].href.replace(".php?dm=on", ".php");
            }
            for(let i = 0; i < deleteForms.length; i++){
                if(checkbox.checked) deleteForms[i].action = deleteForms[i].action.replace("?", "?dm=on&");
                else deleteForms[i].action = deleteForms[i].action.replace("?dm=on&", "?");
            }
        }
    </script>



</header>