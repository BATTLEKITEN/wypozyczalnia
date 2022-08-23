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
	
	$ID_WYP = $_POST['id_wypozyczenia'];

	if(is_null($ID_WYP)==TRUE){
		$_SESSION['powiadomienie'] = "<script type='text/javascript'>alert('Brak wpisanego ID Wypożyczenia!');</script>";
		header('Location: ../panel.php');
	}
	else{
		$sql = "DELETE FROM wypozyczenia WHERE ID='$ID_WYP' AND ID_Uzytkownika='". $_SESSION['id_user'] . "'";
		if(mysqli_query($conn, $sql)){
			$_SESSION['powiadomienie'] = "<script type='text/javascript'>alert('Oddałeś auto!');</script>";
			header('Location: ../panel.php');
		}
		mysqli_close($conn);
	}	
}
?>