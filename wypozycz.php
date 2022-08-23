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
        <h2>Wybierz auto które chcesz wypożyczyć</h2><br>
        <form action="./php/wypozyczenie.php" method="POST" id="wypozyczenie">
        <?php
        include './php/server.php';
        
        $sql = "SELECT * from auta WHERE Wypozyczony = 0";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 0){
            $_SESSION['powiadomienie'] = "<script type='text/javascript'>alert('Brak aut do wypożyczenia!');</script>";
            header('Location: panel.php');
        }
        if (mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_assoc($result)) 
            {
              echo "<input type='radio' required name='id_samochodu' value='". $row['ID']. "'>" . $row["Marka"] . " " . $row['Model'] . " Cena: " . $row["Cena"] . "</option><br>";
            }
        }
        mysqli_close($conn);
        ?>
        <br>
        <button type="submit" form="wypozyczenie" id="przycisk">Wypożycz auto</button>
        </form>
        <input type="submit" value="Powrót do panelu" id="powrot" onclick="window.location='./panel.php'"/>
		<?php
			include "./php/autor.php";
		?>
    </div>
</body>
</html>