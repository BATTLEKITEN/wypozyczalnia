<?php

	session_start();
	
	if (isset($_SESSION['zalogowany']) && $_SESSION['zalogowany']==true)
	{
		header('Location: panel.php');
		exit();
	}

?>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Wypożyczalnia samochodów</title>
    <link rel="stylesheet" href="indexstyle.css">
</head>
<body>
    <div id="tresc">
        <h1>Witaj na stronie wypożyczalni samochodów</h1>
        <h2>Aby skorzystać z naszych usług musisz się zalogować!</h2>

        <form action="./php/logowanie.php" method="POST" enctype="multipart/form-data" autocomplete="off" id="logowanie">
        <input type="text" name="login" placeholder="Login" required>
        <input type="password" name="haslo" placeholder="Haslo" required>
        <button type="submit" form="logowanie" class="przyciski">Zaloguj się!</button>
        </form>

        <h4>Nie masz konta?</h4>
        <form action="./php/rejestracja.php" method="POST" enctype="multipart/form-data" autocomplete="off" id="rejestracja">
        <input type="text" name="login" placeholder="Login" required>
        <input type="password" name="haslo" placeholder="Haslo" required>
        <button type="submit" form="rejestracja" class="przyciski">Zarejestruj się!</button>
        </form>

        <?php
	    if(isset($_SESSION['blad'])){
            echo $_SESSION['blad'];
            unset($_SESSION['blad']);
        }
        include "./php/autor.php";
        ?>
    </div>
</body>
</html>