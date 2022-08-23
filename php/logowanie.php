<?php
	session_start();
    include './server.php';
    
    $_SESSION['zalogowany'] = false;

    $login = $_POST['login'];
    $password = $_POST['haslo'];
    $haslo = hash("sha256", $password);
	if(is_null($login)==TRUE OR is_null($password)==TRUE){
		$_SESSION['blad'] = "<script type='text/javascript'>alert('Brak wpisanego loginu i hasła!');</script>";
		header('Location: ../panel.php');
	}
	else{
    $sql = "SELECT * from uzytkownicy Where Login = '$login' AND Haslo = '$haslo'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){
        $_SESSION['zalogowany'] = true;
        while($row = mysqli_fetch_assoc($result)) 
        {
            $_SESSION['user'] = $row['Login'];
            $_SESSION['grupa'] = $row['Grupa'];
            $_SESSION['id_user'] = $row["ID"];
        }
        unset($_SESSION['blad']);
        header('Location: ../panel.php');
	}
    else{
        $_SESSION['blad'] = "<script type='text/javascript'>alert('Nieprawidłowy login lub hasło!');</script>";
        header('Location: ../index.php');
    }
		mysqli_close($conn);
    }
?>