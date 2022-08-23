<?php
	session_start();
	if ($_SESSION['zalogowany']==false OR $_SESSION['grupa']=="Uzytkownik")
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
        <h2>Lista wypożyczonych aut</h2><br>
        <div id="tabelka">
            <?php
            include './php/server.php';
            
            $sql = "SELECT wypozyczenia.ID,Marka,Model,Login FROM ((wypozyczenia INNER JOIN auta ON wypozyczenia.ID_Samochodu =auta.ID) INNER JOIN uzytkownicy ON wypozyczenia.ID_Uzytkownika = uzytkownicy.ID);";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) ==0){
                $_SESSION['powiadomienie'] = "<script type='text/javascript'>alert('Brak wypożyczonych aut!');</script>";
                header('Location: panel.php');
            }
            if (mysqli_num_rows($result) > 0){
                echo "<table>";
                echo "<tr>";
                echo "<th>ID Wypozyczenia</th>";
                echo "<th>Marka</th>";
                echo "<th>Model</th>";
                echo "<th>Użytkownik</th>";
                echo "</tr>";
              while($row = mysqli_fetch_assoc($result)) 
                {
                    echo "<tr>";
                    echo "<th>" . $row["ID"];
                    echo "<th>" . $row["Marka"];
                    echo "<th>" . $row["Model"];
                    echo "<th>" . $row["Login"];
                    echo "</tr>";
                }
                echo "</table>";
            }
            mysqli_close($conn);
            ?>
        </div>
        <div id="formularze">
            <h3>Które wypożyczenie chcesz usunąć?</h3>
            <form action="./php/usunwypozyczenie.php" method="POST" id="usunwypozyczenie">
            ID Wypożyczenia: <input type="number" name="id_wypozyczenia"><br>
            <br>
            <button type="submit" form="usunwypozyczenie" id="przycisk">Usuń wypożyczenie!</button>
            </form>
        </div>
        <input type="submit" value="Powrót do panelu" id="powrot" onclick="window.location='./panel.php'"/>
		<?php
			include "./php/autor.php";
		?>
    </div>
</body>
</html>