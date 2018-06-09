<?php 

SESSION_START();

if (!isset ($_SESSION) AND empty($_SESSION)) {

header ('location: ./index.php');


}