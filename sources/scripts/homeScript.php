<?php
//--------------------------
//Filename: homeScript.php
//Creation date: 09.05.2017
//Author: Luc Wachter
//Function: The script part of the home page
//--------------------------

$title = "Kairos - Projets";

$projects = array();
$projectTab = getProjects($_SESSION['user_id'], 0, $projects);



?>