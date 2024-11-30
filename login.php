<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@600&family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
<style>
        :root{
            --bg-col: <?php if(!isset($_GET['dm'])) echo '#E5F6FF'; else echo '#425159'; ?>;
        }
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-size: 5px;
            font-family: 'Poppins';
        }
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: var(--bg-col);
        }
        #login-box{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            height: 600px;
            max-height: 80%;
            width: 500px;
            max-width: 90%;
            
            background-color: #689EA5;
            border: 1px solid #4a6981;
            border-radius: 25px;
            box-shadow: 0px 0px 2px rgba(0, 0, 0, 0.5);
        }
        h2{
            margin-bottom: 10px;
            color: #E5F6FF;
            font-size: 6rem;
            font-family: 'Oswald', sans-serif;
        }
        
        form{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            
        }
        .input{
            width: 80%;
            height: auto; 
            padding: 10px;
            margin: 3px;
            border: 2px solid #4a6981;
            border-radius: 10px;
            font-size: 3rem;
            font-family: 'Roboto';
            text-align: center;
            color: black;
            
        }
        button{
            width: 70%;
            padding: 15px;
            margin-top: 2%;

            background-color: #4a6981;
            border: none;
            border-radius: 10px;
            color: white;

            font-size: 3rem;
            font-family: 'Roboto';
        }
        button:hover{
            background-color: #5c82a0;
        }
        #back{
            display: flex;
            justify-content: center;
            align-items: center;

            height: 10vh;
            width: 50vw;

            text-align: center;
            background-color: var(--bg-col);            
        }
        #back-btn{
            color: <?php if(!isset($_GET['dm'])) echo 'black'; else echo 'white' ?>;
            font-size: 4rem;
            text-decoration:none ;
            background-color: rgba(0, 0, 0, 0);
        }
        button{
            cursor: pointer;
            font-weight: 600;
        }
        #wrapper{
            height: 400px;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        body{
            height: 100vh;
        }
        @media (max-width:800px){
            body{
                display: flex;
                justify-content: center;
                align-items: center;
            }
        }
    </style>
</head>

<body>
    <div id="wrapper">
    <div id="login-box">
        <h2>Zaloguj się</h2>
        <form action="panel.php<?php if(isset($_GET['dm'])) echo '?dm=on'; ?>" method="post">
            <input type="text" name="login" placeholder="Nazwa użytkownika" id="login" class="input" required><br>
            <input type="password" name="password" placeholder="Hasło" id="password" class="input" required><br>
            <button type="submit">ZALOGUJ</button>
        </form>
    </div>
    <div id="back">
        <a href="index.php<?php if(isset($_GET['dm'])) echo '?dm=on'; ?>" id="back-btn">Powrót do strony głównej</a>
    </div>
    </div>
</body>
