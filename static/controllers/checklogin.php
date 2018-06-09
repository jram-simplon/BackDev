<?php 


SESSION_START();



if (empty($_SESSION)) {

header ('location:'.$racine.'index.php');


}else{


include '../database/dbconnect.php';


 $alias   =  $_SESSION['alias'];

 $power   =  $_SESSION['pwr'];

 $id_user =  $_SESSION['id_user'];

 $avatar  =  $_SESSION['avatar'];

 $mail    =  $_SESSION['mail'];

 $xp      =  $_SESSION['xp'];

 $since   =  $_SESSION['since'];


 if ($power == 1) {

 	$status = 'Lectrice';
 }



}


?>
