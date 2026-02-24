<?php
	session_start();
	require_once("../settings/connect_datebase.php");
	
	$login = $_POST['login'];
	$password = $_POST['password'];
	
	// ищем пользователя
	$query_user = $mysqli->query("SELECT * FROM `users` WHERE `login`='".$login."'");
	$id = -1;
	
	if($user_read = $query_user->fetch_row()) {
		echo $id;
	} else {
		if($Response->isSuccess()){
			$mysqli->query("INSERT INTO `users`(`login`, `password`, `roll`) VALUES ('".$login."', '".$password."', 0)");
		
			$query_user = $mysqli->query("SELECT * FROM `users` WHERE `login`='".$login."' AND `password`= '".$password."';");
			$user_new = $query_user->fetch_row();
			$id = $user_new[0];

			if($id != -1) $_SESSION['user'] = $id; // запоминаем пользователя
			echo $id;
		} else {
			echo "Пользователь не распознан";
			exit;
		}
	}
?>