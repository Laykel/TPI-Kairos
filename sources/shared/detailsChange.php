<?php
//To execute when the form is submitted
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	//Secure data coming from the form
	$post = secureArray($_POST);
	//Extract the variables from $_POST
	extract($post);

	/*//-------- Data validation --------//
	$qstring = '';

	if(){
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
	//-------- End of data validation --------//*/

	/*if($fTitre != ''){
		$pseudoReq = "UPDATE user SET user_pseudo = '".$fPseudo."'
					  WHERE user_id = ".$_SESSION['user_id'];
		dbRequest($pseudoReq, "update");

		$_SESSION['pseudo'] = $fPseudo;
	}
	if($fEmail != '') {
		$mailReq = "UPDATE user SET user_mail = '".$fEmail."'
				    WHERE user_id = ".$_SESSION['user_id'];
		dbRequest($mailReq, "update");
	}
	if($fPassword != '') {
		$passwordReq = "UPDATE user SET user_password = '".$hashedPassword."'
					    WHERE user_id = ".$_SESSION['user_id'];
		dbRequest($passwordReq, "update");
	}*/

	header('location:'.URL.'?page=home&profileSuccess');
}
?>