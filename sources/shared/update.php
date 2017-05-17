<?php 
include("functions.php");

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

if(isset($_POST['remove-user'])){
	//Remove user request
	$removeReq = "DELETE FROM user
				  WHERE user_id=".$_POST['remove-user'];
	dbRequest($removeReq, "delete");
}

?>