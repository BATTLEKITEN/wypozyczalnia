<?php
	session_start();
	if ($_SESSION['zalogowany']==false OR $_SESSION['grupa']=="Uzytkownik")
	{
		header('Location: ../index.php');
		exit();
		unset($_SESSION['blad']);
	}
	else{
	unset($_SESSION['blad']);
	include './server.php';
	
    $ID_U = $_POST['id_uzytkownika'];
	$ID_S = $_POST['id_samochodu'];

	if(is_null($ID_U)==TRUE OR is_null($ID_S) == TRUE){
		$_SESSION['powiadomienie'] = "<script type='text/javascript'>alert('Brak wpisanego ID Samochodu i ID Użytkownika!');</script>";
		header('Location: ../panel.php');
	}
	else{
		$sql = "INSERT INTO wypozyczenia (ID_Uzytkownika,ID_Samochodu) VALUES ($ID_U,$ID_S)";
		if(mysqli_query($conn, $sql)){
			$_SESSION['powiadomienie'] = "<script type='text/javascript'>alert('Wypożyczyłeś auto użytkownikowi!');</script>";
			header('Location: ../panel.php');
		}
		mysqli_close($conn);
	}
}
?>