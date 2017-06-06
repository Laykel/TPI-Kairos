<?php
//---------------------------------------------------------------
//Filename: homeScript.php
//Creation date: 09.05.2017
//Author: Luc Wachter
//Function: The script part of the home page:
//			gets projects and tasks data, execute changes in DB.
//---------------------------------------------------------------

$title = "Kairos - Projets";

//If the administrator wants to change user data
if($_SESSION['isAdmin'] && isset($_GET['id'])){
	$user_id = $_GET['id'];
	$admin = true;
}
else{
	$user_id = $_SESSION['user_id'];
}

//Get projects and tasks from DB
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

	//Update project or task fields
	if($qstring == ''){

		if(isset($fProject)){
			$updateReq = "UPDATE project SET project_title='".$fTitle."', project_description='".$fDescription."'";

			if($fDateStart == '') $updateReq .= ", project_plannedBeginning=NULL ";
			else $updateReq .= ", project_plannedBeginning='".$fDateStart."'";

			if($fPlannedEnd == '') $updateReq .= ", project_plannedEnd=NULL ";
			else $updateReq .= ", project_plannedEnd='".$fPlannedEnd."' ";

			$updateReq .= "WHERE project_id = ".$fProject;
		}
		else{
			$updateReq = "UPDATE task SET task_title='".$fTitle."', task_description='".$fDescription."', task_timePassed='".$fTimePassed."'";

			if($fDateStart == '') $updateReq .= ", task_plannedBeginning=NULL ";
			else $updateReq .= ", task_plannedBeginning='".$fDateStart."'";

			if($fPlannedEnd == '') $updateReq .= ", task_plannedEnd=NULL ";
			else $updateReq .= ", task_plannedEnd='".$fPlannedEnd."' ";

			$updateReq .= "WHERE task_id = ".$fTask;
		}
		
		dbRequest($updateReq, "update");

		//Reload page with success message
		if($admin)
			header('location:'.URL.'?page=home&changeSuccess&id='.$user_id);
		else
			header('location:'.URL.'?page=home&changeSuccess');
	}
	else{
		//Reload page with error message(s)
		if($admin)
			header('location:'.URL.'?page=home&id='.$user_id.$qstring);
		else
			header('location:'.URL.'?page=home'.$qstring);
	}
}
?>