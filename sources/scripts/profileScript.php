<?php
//--------------------------
//Filename: profileScript.php
//Creation date: 10.05.2017
//Author: Luc Wachter
//Function: The script part of the profile page
//Last modification: 10.05.2017
//--------------------------

$title = "Kairos - Profil";

//Retrieve user data
$userReq = "SELECT user_pseudo, user_mail FROM user
			WHERE user_id='".$_SESSION['user_id']."'";
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
		$qstring .= "&errorEmpty";
	}
	if($fPassword != $fPassword2){
		$qstring .= "&errorPswd";
	}
	if($pseudoAvailable){
		$qstring .= "&existingPseudo";
	}
	if($mailAvailable){
		$qstring .= "&existingEmail";
	}
	//-------- End of data validation --------//

	if($qstring == ''){
		$hashedPassword = password_hash($fPassword, PASSWORD_DEFAULT);

		if($fPseudo != ''){
			$pseudoReq = "UPDATE user SET user_pseudo = '".$fPseudo."'
						  WHERE user_id = ".$_SESSION['user_id'];
		}
		if($fEmail != '') {
			$mailReq = "UPDATE user SET user_mail = '".$fEmail."'
					    WHERE user_id = ".$_SESSION['user_id'];
		}
		if($fPassword != '') {
			$passwordReq = "UPDATE user SET user_password = '".$hashedPassword."'
						    WHERE user_id = ".$_SESSION['user_id'];
		}

    	header('location:'.URL.'?page=home&info=profileSuccess');
    }
    else{
    	header('location:'.URL.'/?page=profile'.$qstring);
    }

	/*if($fPseudo == '' && $fEmail == '' && $fPassword == '' && $fPassword2 == ''){
		header('location:'.URL.'/?page=profile&info=errorEmpty');
	}
	elseif($fPassword != $fPassword2){
		header('location:'.URL.'/?page=profile&info=errorPswd');
	}
	elseif($pseudoAvailable){
		header('location:'.URL.'/?page=profile&info=existingPseudo');
	}
	elseif($mailAvailable){
		header('location:'.URL.'/?page=profile&info=existingEmail');
	}
	else{
		$hashedPassword = password_hash($fPassword, PASSWORD_DEFAULT);

		if($fPseudo != ''){
			$pseudoReq = "UPDATE user SET user_pseudo = '".$fPseudo."'
						 WHERE user_id = ".$_SESSION['user_id'];
		}
		
		if($fEmail != '') {
			$mailReq = "UPDATE user SET user_mail = '".$fEmail."'
					   WHERE user_id = ".$_SESSION['user_id'];
		}
		
		if($fPassword != '') {
			$passwordReq = "UPDATE user SET user_password = '".$hashedPassword."'
						   WHERE user_id = ".$_SESSION['user_id'];
		}

    	header('location:'.URL.'?page=home&info=profileSuccess');
    }*/
}
?>