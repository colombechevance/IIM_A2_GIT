<?php
require('config/config.php');
require('model/functions.fn.php');
session_start();

if(	isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && 
	!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {

	// TODO
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        if(isUsernameAvailable($db, $username)) {
               if(isEmailAvailable($db, $email)) {
                       userRegistration($db, $username, $email, $password);
                    } else {
                       $error = "Email indisponible désolé"; }
    } else {
            $error = "Username indisponible"; }

}else {
	$_SESSION['message'] = 'Erreur : Formulaire incomplet';
	header('Location: register.php');
}

