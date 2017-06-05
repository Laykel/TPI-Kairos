<?php
//---------------------------------------------
//Filename: loginScript.php
//Creation date: 09.05.2017
//Author: Luc Wachter
//Function: The script part of the login page:
//			checks data and log user in.
//---------------------------------------------

$title = "Kairos - Connexion";

//To execute when the form is submitted
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	//Secure data coming from the form
	$post = secureArray($_POST);
	//Extract the variables from $_POST
	extract($post);

	//Retrieve user data
	$userReq = "SELECT user_id, user_password, user_isAdmin FROM user
				WHERE user_pseudo='".$fPseudo."'";
	$userRes = dbRequest($userReq, "select");
	$line = $userRes->fetch();

	//-------- Data validation --------//
	$qstring = '';

	if($fPseudo == '' || $fPassword == ''){
		$qstring .= "&errorEmpty";
	}
	if(!password_verify($fPassword, $line['user_password'])){
		$qstring .= "&errorCo";
	}
	//-------- End of data validation --------//

	if($qstring == ''){
		$_SESSION['isConnected'] = true;
    	$_SESSION['pseudo'] = $fPseudo;
    	$_SESSION['user_id'] = $line['user_id'];
    	$_SESSION['isAdmin'] = $line['user_isAdmin'];

    	header('location:'.URL.'?page=home');
    }
    else{
    	header('location:'.URL.'?page=login'.$qstring);
    }
}
?>