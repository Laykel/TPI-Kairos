<?php
//--------------------------
//Filename: homeScript.php
//Creation date: 11.05.2017
//Author: Luc Wachter
//Function: The script part of the admin page
//--------------------------

$title = "Kairos - Administration";

$userReq = "SELECT * FROM user";
$userRes = dbRequest($userReq, "select");

?>