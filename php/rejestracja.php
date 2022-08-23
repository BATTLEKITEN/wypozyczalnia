<?php
	session_start();
    include './server.php';
    
    $wszystk_ok = true;
    $login = $_POST['login'];
    $password = $_POST['haslo'];
    $haslo = hash("sha256", $password);

    if(is_null($login)==True OR is_null($password)==True){
        $wszystk_ok = false;
        $_SESSION['blad'] = "<script type='text/javascript'>alert('Podaj login i haslo do rejestracji!');</script>";
        header('Location: ../index.php');
    }

    $conn = mysqli_connect($servername, $username, $password, $bd);
    $sprlogin = "SELECT Login from uzytkownicy WHERE Login = '$login'";

    $result1 = mysqli_query($conn, $sprlogin);
    $sql = "INSERT INTO uzytkownicy (Login,Haslo,Grupa) VALUES ('$login','$haslo','Uzytkownik')";

    if (mysqli_num_rows($result1) > 0){
        $wszystk_ok = false;
        $_SESSION['blad'] = "<script type='text/javascript'>alert('Użytkownik już istnieje');</script>";
        header('Location: ../index.php');
	}

    if($wszystk_ok == True){
        if (mysqli_query($conn, $sql)){
            $_SESSION['blad'] = "<script type='text/javascript'>alert('Zarejestrowałeś się! Możesz zalogować się');</script>";
            header('Location: ../index.php');
        }
    }
    mysqli_close($conn);
?>