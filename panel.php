<?php
	session_start();
	if (!isset($_SESSION['zalogowany']) && $_SESSION['zalogowany']==false)
	{
		header('Location: index.php');
		exit();
	}
	unset($_SESSION['blad']);

    if(isset($_SESSION['powiadomienie'])){
        echo $_SESSION['powiadomienie'];
        unset($_SESSION['powiadomienie']);
    }
?>

<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Wypożyczalnia samochodów</title>
    <link rel="stylesheet" href="panelstyle.css">
</head>
<body>  
        <?php
            echo "<h1>Witaj, " . $_SESSION['user']. " !</h1>";
        ?>
            <nav>
                <?php
                    if ($_SESSION['grupa']=="Administrator"){
                        include "./php/navadmin.php";
                    }
                    elseif($_SESSION['grupa']=="Pracownik"){
                        include "./php/navpracownik.php";
                    }
                    else{
                        include "./php/navuzytkownik.php";
                    }
                    include "./php/autor.php";
                ?>
            </nav>
</body>
</html>