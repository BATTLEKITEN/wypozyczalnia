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
        <h2>Lista wypożyczonych aut</h2>
        <div id="tabelka">
            <?php
            include './php/server.php';
            
            $sql = "SELECT * from uzytkownicy";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) ==0){
                $_SESSION['powiadomienie'] = "<script type='text/javascript'>alert('Brak wypozyczonych aut!');</script>";
                header('Location: panel.php');
            }
            if (mysqli_num_rows($result) > 0)
            {
                echo "<table>";
                echo "<tr>";
                echo "<th>ID Użytkownika</th>";
                echo "<th>Login</th>";
                echo "<th>Haslo</th>";
                echo "<th>Grupa</th>";
                echo "</tr>";
              while($row = mysqli_fetch_assoc($result)) 
                {
                    echo "<tr>";
                    echo "<th>" . $row["ID"];
                    echo "<th>" . $row["Login"];
                    echo "<th>" . $row["Haslo"];
                    echo "<th>" . $row["Grupa"];
                    echo "</tr>";
                }
                echo "</table>";
            }
            mysqli_close($conn);
            ?>
        </div>
        <div id="formularze">
            <h3>Zmiana loginu użytkownika</h3>
            <form action="./php/zmianaloginu.php" method="POST" id="zmianaloginu">
            ID Użytkownika: <input type="number" required name="id_uzytkownika"><br>
            Nowy login: <input type="text" required name="login"><br>
            <br>
            <button type="submit" form="zmianaloginu" id="przycisk">Zmień login!</button>
            </form>

            <h3>Zmiana grupy użytkownika</h3>
            <form action="./php/zmianagrupy.php" method="POST" id="zmianagrup">
            ID Użytkownika: <input type="number" required name="id_uzytkownika"><br>
            Nowa grupa:<br>
            <input type='radio' required name='grupa' value="Administrator"> Administrator <br>
            <input type='radio' required name='grupa' value="Pracownik"> Pracownik <br>
            <input type='radio' required name='grupa' value="Uzytkownik">Uzytkownik <br>
            <br>
            <button type="submit" form="zmianagrup" id="przycisk">Zmień grupe</button>
            </form>

            <h3>Zmiana hasła użytkownika</h3>
            <form action="./php/zmianahaslo.php" method="POST" id="zmianahasla">
            ID Użytkownika: <input type="number" required name="id_uzytkownika"><br>
            Nowe hasło: <input type="password" required name="haslo"><br>
            <br>
            <button type="submit" form="zmianahasla" id="przycisk">Zmień hasło!</button>
            </form>

            <h3>Którego użytkownika chcesz usunąć?</h3>
            <form action="./php/usunuzytkownika.php" method="POST" id="usunuzytkownika">
            ID Użytkownika: <input type="number" required name="id_uzytkownika"><br>
            <br>
            <button type="submit" form="usunuzytkownika" id="przycisk">Usuń użytkownika!</button>
            </form>
        </div>
        <input type="submit" value="Powrót do panelu" id="powrot" onclick="window.location='./panel.php'"/>
		<?php
			include "./php/autor.php";
		?>
    </div>
</body>
</html>