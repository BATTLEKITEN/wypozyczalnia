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
        <h2>Lista użytkowników:</h2>
        <div id="tabelka">
            <?php
            include './php/server.php';
            
            $sql = "SELECT * from uzytkownicy";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0){
                echo "<table>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Login</th>";
                echo "</tr>";
              while($row = mysqli_fetch_assoc($result)) 
                {
                    echo "<tr>";
                    echo "<th>" . $row["ID"];
                    echo "<th>" . $row["Login"];
                    echo "</tr>";
                }
                echo "</table>";
            }
            mysqli_close($conn);
            ?>
        </div>
        <div id="formularze">
            <h2>Wybierz auto które chcesz wypożyczyć</h2>
            <form action="./php/wypozyczenie2.php" method="POST" id="wypozyczenie2">
            ID Użytkownika: <input type="number" required name="id_uzytkownika"><br>
            <?php
            include './php/server.php';
            
            $sql = "SELECT * from auta WHERE Wypozyczony = 0";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) == 0){
                $_SESSION['powiadomienie'] = "<script type='text/javascript'>alert('Brak aut do wypozyczenia!');</script>";
                header('Location: panel.php');
            }
            if (mysqli_num_rows($result) > 0)
            {
              while($row = mysqli_fetch_assoc($result)) 
                {
                  echo "<input type='radio' required name='id_samochodu' value='". $row['ID']. "'>" . $row["Marka"] . " " . $row['Model'] . " Cena: " . $row["Cena"] . "</option><br>";
                }
            }
            mysqli_close($conn);
            ?>
            <br>
            <button type="submit" form="wypozyczenie2" id="przycisk">Wypożycz auto</button>
            </form>
        </div>
        <input type="submit" value="Powrót do panelu" id="powrot" onclick="window.location='./panel.php'"/> 
		<?php
			include "./php/autor.php";
		?>
    </div>
</body>
</html>