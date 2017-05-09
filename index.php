<?php
//--------------------------
//Filename: index.php
//Creation date: 09.05.2017
//Author: Luc Wachter
//Function: Main page, includes scripts and secondary pages
//Last modification: 09.05.2017
//--------------------------

session_start();
//Definition of the path to the document root
define('ROOT', dirname('index.php'));
//Definition of the path to the site's index
define('URL', "http://172.17.102.104:8080/tasking/");

//Definition of the current page using the querystring
$page = 'home';
if(isset($_GET['page']) && $_GET['page'] != ''){
    $page = htmlspecialchars($_GET['page']);
}

//Creation of variables to facilitate access to user data
$connected = false;
if(isset($_SESSION['connection'])){
    $connected = true;
    $pseudo = $_SESSION['pseudo'];
    $user_id = $_SESSION['user_id'];
    $admin = $_SESSION['admin'];
}

//Restrict access to login and register for unconnected users
if($connected == false){
	if($page != "login"  && $page != "register")
		header('location:'.URL.'?page=login&info=notco');
}

//Inclusion of the script to connect to the DB, and others
include(ROOT."/sources/scripts/functions.php");

//Inclusion of the script associated to the page
$script = ROOT."/sources/scripts/".$page."Script.php";
if(file_exists($script)){
    include($script);
}
?>