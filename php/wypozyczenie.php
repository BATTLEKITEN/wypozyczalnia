<?php
	session_start();
	if ($_SESSION['zalogowany']==false)
	{
		header('Location: ../index.php');
		exit();
		unset($_SESSION['blad']);
	}
	else{
	unset($_SESSION['blad']);
	include './server.php';
	
	$ID_S = $_POST['id_samochodu'];

	if(is_null($ID_S) == TRUE){
		$_SESSION['powiadomienie'] = "<script type='text/javascript'>alert('Brak wpisanego ID Samochodu');</script>";
		header('Location: ../panel.php');
	}
	else{
		$sql = "INSERT INTO wypozyczenia (ID_Uzytkownika,ID_Samochodu) VALUES ('" . $_SESSION['id_user'] . "','" . $ID_S . "')";
		if(mysqli_query($conn, $sql)){
			$_SESSION['powiadomienie'] = "<script type='text/javascript'>alert('Wypożyczyłeś auto!');</script>";
			header('Location: ../panel.php');
		}
		mysqli_close($conn);
	}
}
?>