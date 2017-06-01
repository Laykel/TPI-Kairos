<?php
//--------------------------
//Filename: registerScript.php
//Creation date: 09.05.2017
//Author: Luc Wachter
//Function: The script part of the register page
//--------------------------

$title = "Kairos - Inscription";

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

	if($fPseudo == '' || $fEmail == '' || $fPassword == '' || $fPassword2 == ''){
		$qstring .= "&errorEmpty";
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
	if(strlen($fPassword) < 6){
		$qstring .= "&errorPswd";
	}
	elseif(!preg_match("~[0-9]~", $fPassword)){
		$qstring .= "&errorPswd";
	}
	elseif($fPassword == strtoupper($fPassword) || $fPassword == strtolower($fPassword)){
		$qstring .= "&errorPswd";
	}
	//-------- End of data validation --------//

	if($qstring == ''){
		$hashedPassword = password_hash($fPassword, PASSWORD_DEFAULT);

		$registerReq = "INSERT INTO user (user_pseudo, user_mail, user_password, user_isAdmin)
						VALUES ('".$fPseudo."', '".$fEmail."', '".$hashedPassword."', 0)";
        dbRequest($registerReq, "insert");

    	header('location:'.URL.'?page=login&success');
    }
    else{
    	header('location:'.URL.'/?page=register'.$qstring);
    }
}
?>
