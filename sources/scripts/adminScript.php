<?php
//--------------------------
//Filename: adminScript.php
//Creation date: 11.05.2017
//Author: Luc Wachter
//Function: The script part of the admin page
//--------------------------

$title = "Kairos - Administration";

//Restrict access to login and register for unconnected users
if(!$_SESSION['isAdmin']){
	if($page == "admin")
		header('location:'.URL.'?page=unknown');
}

$userReq = "SELECT * FROM user";
$userRes = dbRequest($userReq, "select");
?>