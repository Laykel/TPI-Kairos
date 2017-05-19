<?php
//--------------------------
//Filename: update.php
//Creation date: 17.05.2017
//Author: Luc Wachter
//Function: Contains update request to manipulate DB data from JS functions
//--------------------------
session_start();
include("functions.php");
date_default_timezone_set('Europe/Zurich');

if(isset($_POST['add-task'])){
	//Calculate current datetime
	$dateObject = new DateTime();
	$datetime = date_format($dateObject, "Y-m-d H:i:s");

	//New task request
	$createReq = "INSERT INTO task(task_title, task_dateCreation, task_timePassed, task_isClosed, project_fk)
				VALUES('".$_POST['title']."', '".$datetime."', '00:00:00.0', 0, ".$_POST['add-task'].")";
	dbRequest($createReq, "insert");
}

if(isset($_POST['add-project'])){
	//Calculate current datetime
	$dateObject = new DateTime();
	$datetime = date_format($dateObject, "Y-m-d H:i:s");

	//New project request
	$createReq = "INSERT INTO project(project_title, project_dateCreation, project_isClosed, user_fk)
				  VALUES('".$_POST['title']."', '".$datetime."', 0, ".$_SESSION['user_id'].")";
	dbRequest($createReq, "insert");
}

if(isset($_POST['close'])){
	//Close project request
	$closeReq = "UPDATE project SET project_isClosed=1
				 WHERE project_id=".$_POST['close'];
	dbRequest($closeReq, "update");
}

if(isset($_POST['reopen'])){
	//Reopen project request
	$openReq = "UPDATE project SET project_isClosed=0
				WHERE project_id=".$_POST['reopen'];
	dbRequest($openReq, "update");
}

if(isset($_POST['remove-project'])){
	//First remove the tasks
	$removeReq = "DELETE FROM task
				  WHERE project_fk=".$_POST['remove-project'];
	dbRequest($removeReq, "delete");

	//Remove project request
	$removeReq = "DELETE FROM project
				  WHERE project_id=".$_POST['remove-project'];
	dbRequest($removeReq, "delete");
}

if(isset($_POST['remove-task'])){
	//Remove task request
	$removeReq = "DELETE FROM task
				  WHERE task_id=".$_POST['remove-task'];
	dbRequest($removeReq, "delete");
}

if(isset($_POST['remove-account'])){
	//Remove user request
	$removeReq = "DELETE FROM user
				  WHERE user_id=".$_POST['remove-account'];
	dbRequest($removeReq, "delete");
}
?>