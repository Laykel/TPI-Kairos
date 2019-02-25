<?php
//------------------------------------------------------------------------
//Filename: functions.php
//Creation date: 09.05.2017
//Author: Luc Wachter
//Function: Functions used throughout the site: DB manipulation, security
//------------------------------------------------------------------------

//Function to handle every DB call, through PDO
//Returns DB data in case of SELECT, ID in case of insert
function dbRequest($req, $type_req){
    try{
        //Connection to the tasking database
        $connect = new PDO('mysql:host=localhost; dbname=kairos_db;charset=utf8', '***', '***');

        //Allows to get more information from errors
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(Exception $e){
        echo 'Une erreur est survenue! '.$e->getMessage();
        die();
    }

    //Execution of the request
    if($type_req == 'select'){
        //Execute a select req
        $res = $connect->query($req);
    }
    else{
        //Execute a non-select req
        if (false === $connect->exec($req)){
            return false;
        }
        //Set return value to the last inserted ID
        $res = $connect->lastInsertId();
    }
    return ($res);
}

//Function to secure the output of forms, and other arrays
//Returns secured array
function secureArray($array){
    foreach ($array as $key => $value){
        if(is_array($value)){
            $array[$key] = secureArray($value);
        }
        else{
            $array[$key] = htmlentities($value, ENT_QUOTES);
        }
    }
    return $array;
}

//Function to check whether a value is already used in the DB
//Returns boolean
function checkAvailable($data, $column){
    $availableReq = "SELECT ".$column." FROM user
                     WHERE ".$column." = '".$data."'";
    $availableRes = dbRequest($availableReq, "select");
    $line = $availableRes->fetch();

    return $line;
}

//Function used in home.php and journal.php, to get projects and tasks the way we want
//Returns array
function getProjects($user_id, $isClosed, $projectTab){
    //Get user's projects ordered
	$projectReq = "SELECT project_id, project_title, project_plannedEnd FROM project
			   	   WHERE project_isClosed = ".$isClosed."
			   	   AND user_fk = ".$user_id."
			   	   ORDER BY project_plannedEnd IS NULL, project_plannedEnd";
	$projectRes = dbRequest($projectReq, "select");

    //Put all project data in an array, and task data in a sub-array for later use
	while($line = $projectRes->fetch()){
		$taskReq = "SELECT task_id, task_title, task_timePassed, task_plannedEnd, task_isClosed FROM task
					WHERE project_fk = ".$line['project_id']."
					ORDER BY task_plannedEnd IS NULL, task_plannedEnd";
		$taskRes = dbRequest($taskReq, "select");

		$taskTab = array();

		//Store task data in an array
		while($taskLine = $taskRes->fetch()){
			$taskTab[] = array(
					"task_id" => $taskLine['task_id'],
					"task_title" => $taskLine['task_title'],
					"task_timePassed" => $taskLine['task_timePassed'],
					"task_plannedEnd" => $taskLine['task_plannedEnd'],
					"task_isClosed" => $taskLine['task_isClosed'],
			);
		}
        //Store project data and task array in an array
		$projectTab[] = array(
			"project_id" => $line['project_id'],
			"project_title" => $line['project_title'],
			"project_plannedEnd" => $line['project_plannedEnd'],
			"task" => $taskTab,
		);
	}

	return $projectTab;
}
