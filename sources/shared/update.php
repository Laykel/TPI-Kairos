<?php
//--------------------------
//Filename: update.php
//Creation date: 17.05.2017
//Author: Luc Wachter
//Function: Contains update request to manipulate DB data from JS functions
//			JS functions coming from dbUpdate.js and home.php
//--------------------------
session_start();
include("functions.php");
date_default_timezone_set('Europe/Zurich');

$post = secureArray($_POST);
extract($post);

if(isset($addComment)){
	//Calculate current datetime
	$dateObject = new DateTime();
	$datetime = date_format($dateObject, "Y-m-d H:i:s");

	//New task request
	$createReq = "INSERT INTO comment(comment_content, comment_date, task_fk)
				VALUES('".$addComment."', '".$datetime."', ".$id.")";
	dbRequest($createReq, "insert");
}

if(isset($addTask)){
	//Calculate current datetime
	$dateObject = new DateTime();
	$datetime = date_format($dateObject, "Y-m-d H:i:s");

	//New task request
	$createReq = "INSERT INTO task(task_title, task_dateCreation, task_timePassed, task_isClosed, project_fk)
				VALUES('".$title."', '".$datetime."', '00:00:00', 0, ".$addTask.")";
	dbRequest($createReq, "insert");
}

if(isset($addProject)){
	//Calculate current datetime
	$dateObject = new DateTime();
	$datetime = date_format($dateObject, "Y-m-d H:i:s");

	//New project request
	$createReq = "INSERT INTO project(project_title, project_dateCreation, project_isClosed, user_fk)
				  VALUES('".$addProject."', '".$datetime."', 0, ".$user.")";
	dbRequest($createReq, "insert");
}

if(isset($updateTime)){
	//Calculate current datetime
	//$dateObject = new DateTime();
	//$datetime = date_format($dateObject, "Y-m-d H:i:s");

	$currentReq = "SELECT task_timePassed FROM task
				   WHERE task_id=".$id;
	$currentRes = dbRequest($currentReq, "select");
	$line = $currentRes->fetch();

	$secs = strtotime($line['task_timePassed']) - strtotime("00:00:00");
	$newTime = date("H:i:s", strtotime($updateTime) + $secs);

	//New project request
	$timePassedReq = "UPDATE task SET task_timePassed='".$newTime."'
					  WHERE task_id=".$id;
	dbRequest($timePassedReq, "update");
}

if(isset($close)){
	//Close project request
	$closeReq = "UPDATE project SET project_isClosed=1
				 WHERE project_id=".$close;
	dbRequest($closeReq, "update");
}

if(isset($closeTask)){
	//Close task request
	$closeReq = "UPDATE task SET task_isClosed=1
				 WHERE task_id=".$closeTask;
	dbRequest($closeReq, "update");
}

if(isset($reopen)){
	//Reopen project request
	$openReq = "UPDATE project SET project_isClosed=0
				WHERE project_id=".$reopen;
	dbRequest($openReq, "update");
}

if(isset($reopenTask)){
	//Reopen task request
	$openReq = "UPDATE task SET task_isClosed=0
				WHERE task_id=".$reopenTask;
	dbRequest($openReq, "update");
}

if(isset($removeTask)){
	//Remove task request
	$removeReq = "DELETE FROM task
				  WHERE task_id=".$removeTask;
	dbRequest($removeReq, "delete");
}

if(isset($removeProject)){
	//First remove the tasks
	$removeReq = "DELETE FROM task
				  WHERE project_fk=".$removeProject;
	dbRequest($removeReq, "delete");

	//Remove project request
	$removeReq = "DELETE FROM project
				  WHERE project_id=".$removeProject;
	dbRequest($removeReq, "delete");
}

if(isset($removeAccount)){

	$projectReq = "SELECT project_id FROM project 
				   WHERE user_fk=".$removeAccount;
	$projectRes = dbRequest($projectReq, "select");

	//First remove the tasks
	while($line = $projectRes->fetch()){
		$removeReq = "DELETE FROM task
					  WHERE project_fk=".$line['project_id'];
		dbRequest($removeReq, "delete");
	}

	//Then remove the projects
	$removeReq = "DELETE FROM project
				  WHERE user_fk=".$removeAccount;
	dbRequest($removeReq, "delete");

	//Remove user request
	$removeReq = "DELETE FROM user
				  WHERE user_id=".$removeAccount;
	dbRequest($removeReq, "delete");
}
?>