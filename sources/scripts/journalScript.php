<?php
//--------------------------
//Filename: homeScript.php
//Creation date: 11.05.2017
//Author: Luc Wachter
//Function: The script part of the journal page
//--------------------------

$title = "Kairos - Projets";

//If the administrator wants to change user data
if($_SESSION['isAdmin'] && isset($_GET['id'])){
	$user_id = $_GET['id'];
	$admin = true;
}
else{
	$user_id = $_SESSION['user_id'];
}

$projects = array();
$projectTab = getProjects($user_id, 1, $projects);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	//Secure data coming from the form
	$post = secureArray($_POST);
	//Extract the variables from $_POST
	extract($post);
}
?>