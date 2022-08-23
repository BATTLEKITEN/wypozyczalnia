<?php
	session_start();
	if ($_SESSION['zalogowany']==false)
	{
		header('Location: index.php');
		exit();
	}
	unset($_SESSION['blad']);
?>

<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Wypożyczalnia samochodów</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="tresc">
        <?php
            echo "<h1>Witaj, " . $_SESSION['user']. " !</h1>";
        ?>
        <h2>Wybierz, które auto chcesz oddać</h2>
        <form action="./php/oddaj.php" method="POST" id="oddaj">
        <?php
        include './php/server.php';
        
        $sql = "SELECT wypozyczenia.ID,auta.Marka,auta.Model from wypozyczenia INNER JOIN auta on wypozyczenia.ID_Samochodu = auta.ID WHERE wypozyczenia.ID_Uzytkownika = " . $_SESSION['id_user'];
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 0){
            $_SESSION['powiadomienie'] = "<script type='text/javascript'>alert('Nie masz wypożyczonych aut!');</script>";
            header('Location: panel.php');
        }
        if (mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_assoc($result)) 
            {
              echo "<input type='radio' required name='id_wypozyczenia' value='". $row['ID']. "'>" . $row["Marka"] . " " . $row['Model'] . "</option><br>";
            }
        }
        mysqli_close($conn);
        ?>
        <br>
        <button type="submit" form="oddaj" id="przycisk">Oddaj auto</button>
        </form>
        <input type="submit" value="Powrót do panelu" id="powrot" onclick="window.location='./panel.php'"/>
		<?php
			include "./php/autor.php";
		?>
    </div>
</body>
</html>