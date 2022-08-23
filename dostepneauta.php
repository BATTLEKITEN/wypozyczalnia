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
        <h2>Lista dostępnych aut</h2>
        <div id="tabelka">
            <?php
            include './php/server.php';
            
            $sql = "SELECT * from auta WHERE Wypozyczony = 0";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) == 0){
                $_SESSION['powiadomienie'] = "<script type='text/javascript'>alert('Brak aut do wypożyczenia!');</script>";
                header('Location: panel.php');
            }
            if (mysqli_num_rows($result) > 0){
                echo "<table>";
                echo "<tr>";
                echo "<th>Marka</th>";
                echo "<th>Model</th>";
                echo "<th>Cena</th>";
                echo "</tr>";
              while($row = mysqli_fetch_assoc($result)) 
                {
                    echo "<tr>";
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
        <input type="submit" value="Powrót do panelu" id="powrot" onclick="window.location='./panel.php'"/>
		<?php
			include "./php/autor.php";
		?>
    </div>
</body>
</html>