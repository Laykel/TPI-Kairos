<?php
//----------------------------------------------
//Filename: profileScript.php
//Creation date: 10.05.2017
//Author: Luc Wachter
//Function: The script part of the profile page:
//			checks data and changes it in DB.
//----------------------------------------------

$title = "Kairos - Profil";

//If the administrator wants to change user data
if($_SESSION['isAdmin'] && isset($_GET['id'])){
	$user_id = $_GET['id'];
	$admin = true;
}
else{
	$user_id = $_SESSION['user_id'];
}

//Retrieve user data
$userReq = "SELECT user_id, user_pseudo, user_mail FROM user
			WHERE user_id='".$user_id."'";
$userRes = dbRequest($userReq, "select");
$line = $userRes->fetch();

//To execute when the form is submitted
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	//Secure data coming from the form
	$post = secureArray($_POST);
	//Extract the variables from $_POST
	extract($post);

	$pseudoAvailable = checkAvailable($fPseudo, 'user_pseudo');
	$mailAvailable = checkAvailable($fEmail, 'user_mail');

	//-------- Data validation --------//
	$qstring = '';

	if($fPseudo == '' && $fEmail == '' && $fPassword == '' && $fPassword2 == ''){
		$qstring .= "&allEmpty";
	}
	if($fPassword != $fPassword2){
		$qstring .= "&pswdNoMatch";
	}
	if($pseudoAvailable){
		$qstring .= "&existingPseudo";
	}
	if($mailAvailable){
		$qstring .= "&existingEmail";
	}
	if($fPassword != ''){
		if(strlen($fPassword) < 6){
			$qstring .= "&errorPswd";
		}
		elseif(!preg_match("~[0-9]~", $fPassword)){
			$qstring .= "&errorPswd";
		}
		elseif($fPassword == strtoupper($fPassword) || $fPassword == strtolower($fPassword)){
			$qstring .= "&errorPswd";
		}
	}
	//-------- End of data validation --------//

	if($qstring == ''){
		$hashedPassword = password_hash($fPassword, PASSWORD_DEFAULT);

		if($fPseudo != ''){
			$pseudoReq = "UPDATE user SET user_pseudo = '".$fPseudo."'
						  WHERE user_id = ".$user_id;
			dbRequest($pseudoReq, "update");

			//If it wasn't changed by the admin, refresh pseudo
			if(!$admin) $_SESSION['pseudo'] = $fPseudo;
		}
		if($fEmail != '') {
			$mailReq = "UPDATE user SET user_mail = '".$fEmail."'
					    WHERE user_id = ".$user_id;
			dbRequest($mailReq, "update");
		}
		if($fPassword != '') {
			$passwordReq = "UPDATE user SET user_password = '".$hashedPassword."'
						    WHERE user_id = ".$user_id;
			dbRequest($passwordReq, "update");
		}

		if($admin) 
			header('location:'.URL.'?page=admin&profileSuccess');
		else
			header('location:'.URL.'?page=home&profileSuccess');
    }
    else{
    	if($admin)
    		header('location:'.URL.'/?page=profile&id='.$user_id.$qstring);
    	else
    		header('location:'.URL.'/?page=profile'.$qstring);
    }
}
?>
