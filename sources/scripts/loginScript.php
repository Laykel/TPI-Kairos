<?php

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

	if($fPseudo == '' || $fPassword == ''){
		header('location:'.URL.'/?page=login&info=errorEmpty');
	}
	elseif(!password_verify($fPassword, $line['user_password'])){
		header('location:'.URL.'/?page=login&info=errorCo');
	}
	else{
		$_SESSION['connection'] = true;
    	$_SESSION['pseudo'] = $fPseudo;
    	$_SESSION['user_id'] = $line['user_id'];
    	$_SESSION['admin'] = $line['user_isAdmin'];

    	header('location:'.URL.'?page=home&info=success');
    }
}
?>