<?php
//--------------------------------------------------------------------------
//Filename: update.php
//Creation date: 17.05.2017
//Author: Luc Wachter
//Function: Contains database requests to manipulate data from JS functions.
//			JS functions coming from dbUpdate.js and home.php.
//--------------------------------------------------------------------------

session_start();
include("functions.php");
date_default_timezone_set('Europe/Zurich');

//Calculate current datetime
$dateObject = new DateTime();
$datetime = date_format($dateObject, "Y-m-d H:i:s");

//htmlentities each element of the array, then extract the array
$post = secureArray($_POST);
extract($post);

//Add a comment
if(isset($addComment)){
	if($addComment != ''){
		//Add comment to DB
		$createReq = "INSERT INTO comment(comment_content, comment_date, task_fk)
					VALUES('".$addComment."', '".$datetime."', ".$id.")";
		dbRequest($createReq, "insert");
	}
}

//Add a task to a project
if(isset($addTask)){
	//Add task to DB
	$createReq = "INSERT INTO task(task_title, task_dateCreation, task_timePassed, task_isClosed, project_fk)
				VALUES('".$title."', '".$datetime."', '00:00:00', 0, ".$addTask.")";
	dbRequest($createReq, "insert");
}

//Add a project to a user
if(isset($addProject)){
	//Add project to DB
	$createReq = "INSERT INTO project(project_title, project_dateCreation, project_isClosed, user_fk)
				  VALUES('".$addProject."', '".$datetime."', 0, ".$user.")";
	dbRequest($createReq, "insert");
}

//Update the time spent on a task
if(isset($updateTime)){
	//Get the current time spent on the task
	$currentReq = "SELECT task_timePassed FROM task
				   WHERE task_id=".$id;
	$currentRes = dbRequest($currentReq, "select");
	$line = $currentRes->fetch();

	//Add the new session to the total time spent on the task
	$secs = strtotime($line['task_timePassed']) - strtotime("00:00:00");
	$newTime = date("H:i:s", strtotime($updateTime) + $secs);

	//Update task_timePassed with the total time spent
	$timePassedReq = "UPDATE task SET task_timePassed='".$newTime."'
					  WHERE task_id=".$id;
	dbRequest($timePassedReq, "update");
}

//Close a project
if(isset($close)){
	//First set project_dateClosed
	$updateReq = "UPDATE project SET project_dateClosed='".$datetime."'
				  WHERE project_id=".$close;
	dbRequest($updateReq, "update");

	//Close project request
	$closeReq = "UPDATE project SET project_isClosed=1
				 WHERE project_id=".$close;
	dbRequest($closeReq, "update");
}

//Close a task
if(isset($closeTask)){
	//First set task_dateClosed
	$updateReq = "UPDATE task SET task_dateClosed='".$datetime."'
				  WHERE task_id=".$closeTask;
	dbRequest($updateReq, "update");

	//Close task request
	$closeReq = "UPDATE task SET task_isClosed=1
				 WHERE task_id=".$closeTask;
	dbRequest($closeReq, "update");
}

//Reopen a project
if(isset($reopen)){
	//First reset task_dateClosed
	$updateReq = "UPDATE project SET project_dateClosed=null
				  WHERE project_id=".$reopen;
	dbRequest($updateReq, "update");

	//Reopen project request
	$openReq = "UPDATE project SET project_isClosed=0
				WHERE project_id=".$reopen;
	dbRequest($openReq, "update");
}

//Reopen a task
if(isset($reopenTask)){
	//First reset task_dateClosed
	$updateReq = "UPDATE task SET task_dateClosed=null
				  WHERE task_id=".$reopenTask;
	dbRequest($updateReq, "update");

	//Reopen task request
	$openReq = "UPDATE task SET task_isClosed=0
				WHERE task_id=".$reopenTask;
	dbRequest($openReq, "update");
}

//Remove a task
if(isset($removeTask)){
	//Remove task request
	$removeReq = "DELETE FROM task
				  WHERE task_id=".$removeTask;
	dbRequest($removeReq, "delete");
}

//Remove a project
if(isset($removeProject)){
	//First remove the tasks
	$removeReq = "DELETE FROM task
				  WHERE project_fk=".$removeProject;
	dbRequest($removeReq, "delete");

	//Then remove project
	$removeReq = "DELETE FROM project
				  WHERE project_id=".$removeProject;
	dbRequest($removeReq, "delete");
}

//Generate a new password, change it and send it by email
if(isset($forgottenPswd)){
	$mailAvailable = checkAvailable($forgottenPswd, 'user_mail');

	if($mailAvailable){
		//Generate new password
	    $length = 10;
	    $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $password = '';

	    $max = mb_strlen($keyspace, '8bit') - 1;
	    if ($max < 1) {
	        throw new Exception('$keyspace must be at least two characters long');
	    }
	    for ($i = 0; $i < $length; $i++) {
	        $password .= $keyspace[random_int(0, $max)];
	    }

		//Hash new password
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

		//Update password in DB
		$updateReq = "UPDATE user SET user_password='".$hashedPassword."'
					  WHERE user_mail='".$forgottenPswd."'";
		dbRequest($updateReq, "update");

		//Set different mail components
		$subject = "Kairos Projects: Mot de passe oublié";

		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: kairos@lwachter.mycpnv.ch';

		$content = "Cher utilisateur,<br><br>Quelqu'un a demandé une réinitialisation du mot de passe lié à cette adresse e-mail.<br><br>Votre nouveau mot de passe est: ".$password."<br><br>Si vous n'avez pas demandé cette réinitialisation, ne vous inquiétez pas. Vous êtes la seule personne à recevoir ce mail, votre compte est donc en sécurité.<br><br>Meilleures salutations,<br>L'équipe Kairos";

		//Send mail
		mail($forgottenPswd, $subject, $content, $headers);
	}
}

//Remove an account
if(isset($removeAccount)){
	
	//Get IDs of all the user's projects
	$projectReq = "SELECT project_id FROM project 
				   WHERE user_fk=".$removeAccount;
	$projectRes = dbRequest($projectReq, "select");

	while($line = $projectRes->fetch()){

		//Get IDs of all the project's tasks
		$taskReq = "SELECT task_id FROM task 
					WHERE project_fk=".$line['project_id'];
		$taskRes = dbRequest($taskReq, "select");

		//First remove the comments of all the user's tasks
		while($taskLine = $taskRes->fetch()){
			$removeCommentReq = "DELETE FROM comment
						  		 WHERE task_fk=".$taskLine['task_id'];
			dbRequest($removeCommentReq, "delete");
		}

		//Then remove the tasks of all the user's projects
		$removeReq = "DELETE FROM task
					  WHERE project_fk=".$line['project_id'];
		dbRequest($removeReq, "delete");
	}

	//Then remove the projects
	$removeReq = "DELETE FROM project
				  WHERE user_fk=".$removeAccount;
	dbRequest($removeReq, "delete");

	//And remove user
	$removeReq = "DELETE FROM user
				  WHERE user_id=".$removeAccount;
	dbRequest($removeReq, "delete");
}
?>