<?php

SESSION_START();

// connection to the database

include '../database/dbconnect.php';

// connection test 

// $sql = 'select * from users';
// $query = $db->query($sql);
// $users = $query-> fetchAll();

// foreach ($users as $user) {

// 	echo $user['surname'].'<br>';
// 
// }


/// ???? A VERIF
$alias       = htmlspecialchars(preg_replace('/ /', '',$_POST['alias']));


 if    ( empty($_POST['mail']) OR empty($_POST['pwd'])) {

	echo "Merci de remplir tous les champs !";

 }


if (    	isset($_POST['mail'])  AND !empty($_POST['mail'])
		AND isset($_POST['pwd'])   AND !empty($_POST['pwd'])

	){


$mail        = htmlspecialchars(strtolower(preg_replace('/ /', '',$_POST['mail'])));

$pwd        = htmlspecialchars($_POST['pwd']);



$req        = 'SELECT mail FROM users WHERE mail = "'.$mail.'"';
$query      = $db->query($req);
$checkmail = $query->fetchColumn();


		if ($checkmail == $mail){

$req        = 'SELECT pwd FROM users WHERE mail = "'.$mail.'"';
$query      = $db->query($req);
$checkpwd = $query->fetchColumn();


			if (password_verify($pwd, $checkpwd)) {

$req        = 'SELECT * FROM users WHERE mail = "'.$mail.'"';
$query      = $db->prepare($req);
$query      ->execute();
$user       = $query->fetch();

				SESSION_START();

				$_SESSION['alias']   = $user['alias'];
				$_SESSION['id_user'] = $user['id_user'];
				$_SESSION['pwr']     = $user['pwr'];
				$_SESSION['mail']    = $user['mail'];
				$_SESSION['avatar']  = $user['avatar'];
				$_SESSION['since']   = $user['inscription_date'];
				$_SESSION['xp']      = $user['xp'];

       		header ('location: ../../index.php');

			} else {

				echo "mot de passe incorrect !";
			}

		} else {

			echo 'Email incorrect !';
		
	}

}		


?>