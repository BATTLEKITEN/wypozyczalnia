<?php
	session_start();
	if ($_SESSION['zalogowany']==false OR $_SESSION['grupa']=="Uzytkownik" OR $_SESSION['grupa']=="Pracownik")
	{
		header('Location: ../index.php');
		exit();
		unset($_SESSION['blad']);
	}
	else{
	unset($_SESSION['blad']);
	include './server.php';
	
	$ID_U = $_POST['id_uzytkownika'];
    $password = $_POST['haslo'];
    $haslo = hash("sha256", $password);

	if(is_null($ID_U)==TRUE OR is_null($password) == TRUE){
		$_SESSION['powiadomienie'] = "<script type='text/javascript'>alert('Brak wpisanego hasła i ID Użytkownika!');</script>";
		header('Location: ../zarzadzajuzytkownikami.php');
	}
	else{
		$sql = "UPDATE uzytkownicy SET Haslo = '$haslo' WHERE ID = '$ID_U'";
		if(mysqli_query($conn, $sql)){
			$_SESSION['powiadomienie'] = "<script type='text/javascript'>alert('Zmieniłeś haslo!');</script>";
			header('Location: ../zarzadzajuzytkownikami.php');
		}
    	else{
    		$_SESSION['powiadomienie'] = "<script type='text/javascript'>alert('Nie udało się zmienić hasła!');</script>";
    	}
		mysqli_close($conn);
	}
}
?>