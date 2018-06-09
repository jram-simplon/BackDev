<?php


// Page de verif de la Session, si Session inexistante -> redirection vers index.php
include './static/controllers/checklogin.php';


// SOUCIS AU NIVEAU DU PATH A REGLER

include './static/database/dbconnect.php';

// connection test 

//$sql = 'select * from users';
//$query = $db->query($sql);
//$users = $query-> fetchAll();

//foreach ($users as $user) {

//	echo $user['alias'].'<br>';
 
//}


echo 'Pseudo : '.$alias.'<br>';
echo 'Status : '.$status.'<br>';
echo 'Email : '.$mail.'<br>';
echo 'XP : '.$xp.'<br>';
echo 'Inscrit depuis le : '.$since;
echo '<img src=./static/uploads/avatars/'.$avatar.'><br>';


?>

<fieldset><legend>Email</legend>
		<form action="./static/controllers/editprofil.php" method="post">
     	<?php echo 'Email actuel : '.$mail.'<br>' ?>     
        <label for="newmail">Nouvel Email :</label>
        <input type="text" name="mail1" id="mail1" /><br />
        <label for="confirm">Confirmer le nouvel Email : </label>
        <input type="text" name="mail2" id="mail2"  />
       <input type="submit" name="changemail" value="Valider" >
   </form>
        </fieldset><br>


        <fieldset><legend>Password</legend>
		<form action="./static/controllers/editprofil.php" method="post">
        <label for="actualpwd">Password Actuel :</label>
        <input type="text" name="pwd" id="pwd" /><br />
        <label for="newpwd">Nouveau Password :</label>
        <input type="text" name="pwd1" id="pwd1" /><br />
        <label for="confirm">Confirmer le nouveau Password: </label>
        <input type="text" name="pwd2" id="pwd2"  />
       <input type="submit" name="changepwd" value="Valider" >
   </form>
        </fieldset>



