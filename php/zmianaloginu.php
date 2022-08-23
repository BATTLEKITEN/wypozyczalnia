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
    $login = $_POST['login'];

	if(is_null($ID_U)==TRUE OR is_null($login) == TRUE){
		$_SESSION['powiadomienie'] = "<script type='text/javascript'>alert('Brak wpisanego loginu i ID użytkownika!');</script>";
		header('Location: ../zarzadzajuzytkownikami.php');
	}
	else{
		$sql = "UPDATE uzytkownicy SET Login = '$login' WHERE ID = '$ID_U'";
		if(mysqli_query($conn, $sql)){
			$_SESSION['powiadomienie'] = "<script type='text/javascript'>alert('Zmieniłeś login!');</script>";
			header('Location: ../zarzadzajuzytkownikami.php');
		}
    	else{
        	$_SESSION['powiadomienie'] = "<script type='text/javascript'>alert('Nie udało się zmienić loginu!');</script>";
    	}
		mysqli_close($conn);
	}
}
?>