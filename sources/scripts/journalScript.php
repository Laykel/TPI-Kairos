<?php
//--------------------------
//Filename: homeScript.php
//Creation date: 11.05.2017
//Author: Luc Wachter
//Function: The script part of the journal page
//--------------------------

$title = "Kairos - Projets";


$projects = array();
$projectTab = getProjects($_SESSION['user_id'], 1, $projects);


?>