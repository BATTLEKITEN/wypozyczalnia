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

	if(is_null($ID_U)==TRUE){
		$_SESSION['powiadomienie'] = "<script type='text/javascript'>alert('Brak wpisanego ID Użytkownika!');</script>";
		header('Location: ../zarzadzajuzytkownikami.php');
	}
	else{
		$sql = "DELETE FROM uzytkownicy WHERE ID='$ID_U'";
		if(mysqli_query($conn, $sql)){
			$_SESSION['powiadomienie'] = "<script type='text/javascript'>alert('Usunąłeś użytkownika!');</script>";
			header('Location: ../zarzadzajuzytkownikami.php');
	}
		mysqli_close($conn);
	}
}
?>