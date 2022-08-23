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
	
    $marka = $_POST["marka"];
    $model = $_POST["model"];
    $cena = $_POST["cena"];

	if(is_null($marka)==TRUE OR is_null($model)==TRUE OR is_null($cena)==TRUE){
		$_SESSION['powiadomienie'] = "<script type='text/javascript'>alert('Brak wpisanej marki, modelu i ceny auta!');</script>";
		header('Location: ../zarzadzajautami.php');
	}
	else{
	$sql = "INSERT INTO auta (Marka,Model,Cena) VALUES ('$marka','$model','$cena')";
		if(mysqli_query($conn, $sql)){
			$_SESSION['powiadomienie'] = "<script type='text/javascript'>alert('Dodałeś auto!');</script>";
			header('Location: ../zarzadzajautami.php');
		}
		mysqli_close($conn);
	}
}
?>