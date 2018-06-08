<?php


// id6036374_db_sheeks
// id6036374_jram
// jr4msh33ks


try {

$user = 'root';
$password = 'root';
$db = new PDO('mysql:host=localhost;dbname=db_sheeks', $user, $password);

}

catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

?>