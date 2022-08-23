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
    $grupa = $_POST['grupa'];

	if(is_null($ID_U)==TRUE OR is_null($grupa) == TRUE){
		$_SESSION['powiadomienie'] = "<script type='text/javascript'>alert('Brak wpisanej grupy i ID Użytkownika!');</script>";
		header('Location: ../zarzadzajuzytkownikami.php');
	}
	else{
		$sql = "UPDATE uzytkownicy SET Grupa = '$grupa' WHERE ID = '$ID_U'";
		if(mysqli_query($conn, $sql)){
			$_SESSION['powiadomienie'] = "<script type='text/javascript'>alert('Zmieniłeś grupę!');</script>";
			header('Location: ../zarzadzajuzytkownikami.php');
		}
    	else{
        	$_SESSION['powiadomienie'] = "<script type='text/javascript'>alert('Nie udało się zmienić grupy!');</script>";
    	}
		mysqli_close($conn);
	}
}
?>