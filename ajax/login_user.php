<?php
    session_start();
    require_once("../settings/connect_datebase.php");
    
    $login = $_POST['login'];
    $password = $_POST['password'];

    if($Response->isSuccess()){
        $query_user = $mysqli->query("SELECT * FROM `users` WHERE `login`='".$login."' AND `password`= '".$password."';");
        
        $id = -1;
        while($user_read = $query_user->fetch_row()) {
            $id = $user_read[0];
        }
        
        if($id != -1) {
            $_SESSION['user'] = $id;
        }
        echo md5(md5($id));
    } else {
        echo "Пользователь не распознан";
        exit;
    }
?>