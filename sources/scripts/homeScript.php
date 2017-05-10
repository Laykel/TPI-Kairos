<?php
//--------------------------
//Filename: homeScript.php
//Creation date: 09.05.2017
//Author: Luc Wachter
//Function: The script part of the home page
//--------------------------

$title = "Kairos - Projets";

$projectReq = "SELECT project_id, project_title, project_plannedEnd FROM project
			   WHERE project_isClosed = 0
			   AND user_fk = ".$_SESSION['user_id'];
$projectRes = dbRequest($projectReq, "select");

while($line = $projectRes->fetch()){

	$taskReq = "SELECT task_id, task_title, task_timePassed, task_isClosed FROM task
				WHERE project_fk = ".$line['project_id'];
	$taskRes = dbRequest($taskReq, "select");

	$taskTab = array();

	//Store data in an array
	while($taskLine = $taskRes->fetch()){
		$taskTab[] = array(
				"task_id" => $taskLine['task_id'],
				"task_title" => $taskLine['task_title'],
				"task_timePassed" => $taskLine['task_timePassed'],
				"task_isClosed" => $taskLine['task_isClosed'],
		);
	}

	$projectTab[] = array(
		"project_id" => $line['project_id'],
		"project_title" => $line['project_title'],
		"project_plannedEnd" => $line['project_plannedEnd'],
		"task" => $taskTab,
	);
}
?>