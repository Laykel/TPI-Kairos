<?php
//--------------------------
//Filename: homeScript.php
//Creation date: 09.05.2017
//Author: Luc Wachter
//Function: The script part of the home page
//--------------------------

$title = "Kairos - Projets";

//If the administrator wants to change user data
if($_SESSION['isAdmin'] && isset($_GET['id'])){
	$user_id = $_GET['id'];
	$admin = true;
}
else{
	$user_id = $_SESSION['user_id'];
}

$projects = array();
$projectTab = getProjects($user_id, 0, $projects);

//Calculate current datetime
date_default_timezone_set('Europe/Zurich');
$dateObject = new DateTime();
$datetime = date_format($dateObject, "Y-m-d H:i:s");

//To execute when the form is submitted
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	//Secure data coming from the form
	$post = secureArray($_POST);
	//Extract the variables from $_POST
	extract($post);

	//-------- Data validation --------//
	$qstring = '';

	if($fTitle == ''){
		$qstring .= "&titleEmpty";
	}
	if($fDateStart != '' && DateTime::createFromFormat('Y-m-d H:i:s', $fDateStart) == FALSE){
		$qstring .= "&errorDate";
	}
	if($fPlannedEnd != '' && DateTime::createFromFormat('Y-m-d H:i:s', $fPlannedEnd) == FALSE){
		$qstring .= "&errorDate";
	}
	if(isset($fTimePassed) && DateTime::createFromFormat('H:i:s', $fTimePassed) == FALSE){
		$qstring .= "&errorTime";
	}
	//-------- End of data validation --------//

	if($qstring == ''){
		//
		if($fTitle != ''){
			if(isset($fProject)){
				$titleReq = "UPDATE project SET project_title = '".$fTitle."'
							 WHERE project_id = ".$fProject;
			}
			else{
				$titleReq = "UPDATE task SET task_title = '".$fTitle."'
							 WHERE task_id = ".$fTask;
			}
			
			dbRequest($titleReq, "update");
		}
		//
		if($fDescription != ''){
			if(isset($fProject)){
				$descReq = "UPDATE project SET project_description = '".$fDescription."'
							 WHERE project_id = ".$fProject;
			}
			else{
				$descReq = "UPDATE task SET task_description = '".$fDescription."'
							 WHERE task_id = ".$fTask;
			}
			
			dbRequest($descReq, "update");
		}
		//
		if($fDateStart != ''){
			if(isset($fProject)){
				$dateReq = "UPDATE project SET project_plannedBeginning = '".$fDateStart."'
							 WHERE project_id = ".$fProject;
			}
			else{
				$dateReq = "UPDATE task SET task_plannedBeginning = '".$fDateStart."'
							 WHERE task_id = ".$fTask;
			}
			
			dbRequest($dateReq, "update");
		}
		//
		if($fPlannedEnd != ''){
			if(isset($fProject)){
				$endReq = "UPDATE project SET project_plannedEnd = '".$fPlannedEnd."'
							 WHERE project_id = ".$fProject;
			}
			else{
				$endReq = "UPDATE task SET task_plannedEnd = '".$fPlannedEnd."'
							 WHERE task_id = ".$fTask;
			}
			
			dbRequest($endReq, "update");
		}
		//
		if(isset($fTimePassed)){
			$timeReq = "UPDATE task SET task_timePassed = '".$fTimePassed."'
					   WHERE task_id = ".$fTask;
			dbRequest($timeReq, "update");
		}
		if($admin)
			header('location:'.URL.'?page=home&changeSuccess&id='.$user_id);
		else
			header('location:'.URL.'?page=home&changeSuccess');
	}
	else{
		if($admin)
			header('location:../../?page=home&id='.$user_id.$qstring);
		else
			header('location:../../?page=home'.$qstring);
	}
}
?>