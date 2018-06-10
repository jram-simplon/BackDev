
<?php

include './checklogin.php';

/////////////////////// MAIL CHANGE BEGIN

$mail1        = htmlspecialchars(strtolower(preg_replace('/ /', '',$_POST['mail1'])));
$mail2        = htmlspecialchars(strtolower(preg_replace('/ /', '',$_POST['mail2'])));

if (isset($_POST['changemail'])) {

if (empty($_POST['mail1']) OR empty($_POST['mail2'])) {

	echo 'Merci de remplir tous les champs !';

}else {
	

	if ( isset($_POST['mail1'])   AND !empty($_POST['mail1'])
	AND  isset($_POST['mail2'])   AND !empty($_POST['mail2'])

	
	){


// FONCTION VERIF MAIL -> A CHANGER EN MODE MVC A LA FIN

$searchmail = 'SELECT COUNT(*) AS nbr FROM users WHERE mail = "'.$mail1.'"';
$verifmail  = $db->query($searchmail);


if ($verifmail ->fetchColumn() != 0) {

	
	echo 'Mail déjà utilisé !'; 


}else if ($mail1 != $mail2){

   echo 'Les Emails sont différents !';

}else{


$req      = 'UPDATE users SET mail = :newmail WHERE alias = :alias';
$requete  = $db->prepare($req);
$requete2 = $requete->execute(array(

 									":alias"      => $alias,
 									":newmail"    => $mail1,
 			));

$_SESSION['mail'] = $mail1;
header ('location: ../../profil.php');

		}

	}

}

}

///////////////////////////// MAIL CHANGE END

//////////////////////////// PASSWORD CHANGE BEGIN


$pwd         = htmlspecialchars($_POST['pwd']);
$pwd1        = htmlspecialchars($_POST['pwd1']);
$pwd2        = htmlspecialchars($_POST['pwd2']);
$pwdhash     = password_hash($pwd1, PASSWORD_DEFAULT);

if (isset($_POST['changepwd'])) {

	if (empty($_POST['pwd']) OR empty($_POST['pwd1']) OR empty($_POST['pwd2'])) {

	echo 'Merci de remplir tous les champs !';


		}elseif ($pwd1 != $pwd2) {

				echo 'Les Passwords sont différents !';


}elseif (		  isset($_POST['pwd'])   AND !empty($_POST['pwd'])
		 AND  isset($_POST['pwd1'])  AND !empty($_POST['pwd1'])
	     AND  isset($_POST['pwd2'])  AND !empty($_POST['pwd2'])

	
	){

// FONCTION VERIF PWD -> A CHANGER EN MODE MVC A LA FIN

$req        = 'SELECT pwd FROM users WHERE mail = "'.$mail.'"';
$query      = $db->query($req);
$checkpwd = $query->fetchColumn();


if (password_verify($pwd, $checkpwd)) {


 $req        = 'UPDATE users SET pwd = :newpwd WHERE alias = :alias';
 $requete    = $db->prepare($req);
 $requete2   = $requete->execute(array(

 										":alias"   => $alias,
 										":newpwd"  =>  $pwdhash,
 			));

 		echo 'Password changé !';
 		header ('location: ../../profil.php');

		
	}else{

		echo 'Mauvais Password !';
	}

}

}

/////////////////////////// PASSWORD CHANGE END

////////////////////////// AVATAR CHANGE BEGIN


// -> FONCTION A MODIF MVC A LA FIN

// Variables réservée à l'ajout d'avatar	

$oldavatar = $avatar;

if (isset($_POST['avatarchange'])) {

$avatar_default  = "avatar_default.jpg";
$avatar          = $_FILES['avatar'];
$avatar_name     = preg_replace('/ /', '',$_FILES['avatar']['name']);
$avatar_type     = pathinfo($avatar_name, PATHINFO_EXTENSION);
$avatar_dbname   = strtolower($alias.'_avatar.'.$avatar_type);
$avatar_size     = $_FILES['avatar']['size'];
$autorised_type  = array('jpg', 'jpeg', 'svg', 'png');


 	if (isset($avatar) AND $_FILES['avatar']['error'] == 0) {

 		if($avatar_size <= 100000) {

 			if ((in_array($avatar_type, $autorised_type))) { 



 			unlink ('../uploads/avatars/'.$oldavatar);

 			move_uploaded_file($_FILES['avatar']['tmp_name'], '../uploads/avatars/'.basename($avatar_dbname));


 			$av_change  = 'UPDATE users SET avatar = :newavatar WHERE alias = :alias';
 			$av_change2 = $db->prepare($av_change);
 			$requete2   = $av_change2->execute(array(

 													":alias"      => $alias,
 													":newavatar"  =>  $avatar_dbname,

 			));

 			echo 'Avatar Changé !';

 			$_SESSION['avatar'] = $avatar_dbname;
			header ('location: ../../profil.php');


 			}			

 		} 

 		echo "Fichier trop volumineux !";
 		header ('location: ../../profil.php');

 	}

 	echo "Aucun avatar sélectionné !";
 	header ('location: ../../profil.php');

 }

////////////////////////// AVATAR CHANGE END


?>