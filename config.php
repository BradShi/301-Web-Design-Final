<?php

$password = 'DrA7ruDe';
$username = 'hicksb8';

$database = new PDO('mysql:host=csweb.hh.nku.edu;dbname=db_spring19_hicksb8', $username, $password);

function my_autoloader($class){include ('classes/class.' . $class . '.php');}
spl_autoload_register('my_autoloader');


session_start();



$current_url = basename($_SERVER['REQUEST_URI']);
 if (!isset($_SESSION["userID"]) && $current_url != 'login.php') {
    header("Location: login.php");
}
elseif (isset($_SESSION["userID"])) {
	$sql = file_get_contents('sql/getUser.sql');
	$params = array(
		'userID' => $_SESSION["userID"]
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$users = $statement->fetchAll(PDO::FETCH_ASSOC);
	
	$user = $users[0];
}

?>

