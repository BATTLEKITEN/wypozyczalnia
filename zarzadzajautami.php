<?php
	session_start();
	if ($_SESSION['zalogowany']==false OR $_SESSION['grupa']=="Uzytkownik" OR $_SESSION['grupa']=="Pracownik")
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
            
            $sql = "SELECT * from auta";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) == 0){
                $_SESSION['powiadomienie'] = "<script type='text/javascript'>alert('Brak wypozyczonych aut!');</script>";
                header('Location: panel.php');
            }
            if (mysqli_num_rows($result) > 0)
            {
                echo "<table>";
                echo "<tr>";
                echo "<th>ID Auta</th>";
                echo "<th>Marka</th>";
                echo "<th>Model</th>";
                echo "<th>Cena</th>";
                echo "</tr>";
              while($row = mysqli_fetch_assoc($result)) 
                {
                    echo "<tr>";
                    echo "<th>" . $row["ID"];
                    echo "<th>" . $row["Marka"];
                    echo "<th>" . $row["Model"];
                    echo "<th>" . $row["Cena"];
                    echo "</tr>";
                }
                echo "</table>";
            }
            mysqli_close($conn);
            ?>
        </div>
        <br>
        <div id="formularze">
            <h2>Które auto chcesz usunąć?</h2>
            <form action="./php/usunauto.php" method="POST" id="usunuauto">
            <h3>ID Auta:</h3><input type="number" required name="id_auta"><br>
            <br>
            <button type="submit" form="usunuauto" id="przycisk">Usuń auto!</button>
            </form>
            <br>

            <h2>Dodaj auto</h2>
            <form action="./php/dodajauto.php" method="POST" id="dodajauto">
            Marka: <input type="text" requred name="marka">
            Model: <input type="text" requred name="model">
            Cena: <input type="number" requred name="cena"><br>
            <br>
            <button type="submit" form="dodajauto" id="przycisk">Dodaj auto!</button>
            </form>
        </div>
        <br>
        <input type="submit" value="Powrót do panelu" id="powrot" onclick="window.location='./panel.php'"/> 
		<?php
			include "./php/autor.php";
		?>
    </div>
</body>
</html>