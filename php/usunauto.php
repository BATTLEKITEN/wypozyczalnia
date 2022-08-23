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
	
	$ID_A = $_POST['id_auta'];

	if(is_null($ID_A)==TRUE){
		$_SESSION['powiadomienie'] = "<script type='text/javascript'>alert('Brak wpisanego ID Auta!');</script>";
		header('Location: ../zarzadzajautami.php');
	}
	else{
		$sql = "DELETE FROM auta WHERE ID='$ID_A'";
		if(mysqli_query($conn, $sql)){
			$_SESSION['powiadomienie'] = "<script type='text/javascript'>alert('Usunąłeś auto!');</script>";
			header('Location: ../zarzadzajautami.php');
		}
		mysqli_close($conn);
	}
}
?>