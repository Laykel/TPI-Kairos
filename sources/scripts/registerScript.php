<?php

$title = "Kairos - Inscription";

//To execute when the form is submitted
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	//Secure data coming from the form
	$post = secureArray($_POST);
	//Extract the variables from $_POST
	extract($post);

	//-----------------------------------------------------------
	//Should be in a function
	//Check pseudo availability
	$pseudoReq = "SELECT user_pseudo FROM user
				  WHERE user_pseudo = '".$fPseudo."'";
	$pseudoRes = dbRequest($pseudoReq, "select");
	$line = $pseudoRes->fetch();

	//Check email availability
	$emailReq = "SELECT user_mail FROM user
				 WHERE user_mail = '".$fEmail."'";
	$emailRes = dbRequest($pseudoReq, "select");
	$eLine = $emailRes->fetch();
	//-----------------------------------------------------------

	if($fPseudo == '' || $fEmail == '' || $fPassword == '' || $fPassword2 == ''){
		header('location:'.URL.'/?page=register&info=errorEmpty');
	}
	elseif($fPassword != $fPassword2){
		header('location:'.URL.'/?page=register&info=errorPswd');
	}
	elseif($line['pseudo'] == $fPseudo){
		header('location:'.URL.'/?page=register&info=existingPseudo');
	}
	elseif($eLine['user_mail'] == $fEmail){
		header('location:'.URL.'/?page=register&info=existingEmail');
	}
	else{
		$hashedPassword = password_hash($fPassword, PASSWORD_DEFAULT);

		$registerReq = "INSERT INTO user (user_pseudo, user_mail, user_password, user_isAdmin)
						VALUES ('".$fPseudo."', '".$fEmail."', '".$hashedPassword."', 0)";
        dbRequest($registerReq, "insert");

    	header('location:'.URL.'?page=login&info=success');
    }
}
?>