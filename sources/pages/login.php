<!-- 
Filename: login.php
Description: Login page: form, forgotten password mechanism.
-->

<div class="row"><h1 class="page-title">Connexion</h1></div>

<!-- Connection form -->
<div class="row">
	<div class="col-sm-6 col-sm-offset-3">

	    <!-- Alert messages-->
	    <?php include(ROOT."/sources/shared/alerts.php"); ?>

	    <!-- Form -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Connectez-vous à votre compte</h3>
			</div>

			<div class="panel-body">
				<form method="post" action="">
					<div class="form-group">
						<label for="pseudo">Votre pseudonyme</label>
						<input type="text" class="form-control" id="pseudo" name="fPseudo" maxlength="45">
					</div>
					<div class="form-group">
						<label for="pswd">Votre mot de passe</label>
						<input type="password" class="form-control" id="pswd" name="fPassword" maxlength="500">
					</div>
					<button type="submit" class="btn btn-primary pull-right">Se connecter</button>
				</form>
				<a href="<?php echo URL;?>?page=register"><button class="btn btn-link pull-left">Page d'inscription</button></a>
			</div>
		</div>
	</div>
</div>
<!-- Connection form end-->

<!-- Forgotten password -->
<div class="row">
	<div class="col-sm-6 col-sm-offset-3">
		<a href="#"><button class="btn btn-link" id="forgottenPswd">Mot de passe oublié?</button></a>
		<div id="pswdDiv" class="well" hidden="">
			<p>Veuillez entrer l'adresse e-mail avec laquelle vous vous êtes inscrit(e) ci-dessous. Un nouveau mot de passe vous sera envoyé à cette adresse.</p>
			<p>Si vous entrez une adresse e-mail erronée, ou qui ne vous appartient pas, vous ne recevrez rien.</p>
			<table width="100%">
				<tr>
					<td>
						<input type="email" class="form-control" id="email" placeholder="exemple@test.ch" maxlength="254">
					</td>
					<td>&nbsp&nbsp&nbsp</td>
					<td>
						<button class="btn btn-primary" id="sendMail">Envoyer</button>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>

<!-- Site description -->
<hr>
<div class="row">
	<h2>Description du site</h2>
 	
 	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
 	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
 	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
 	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
 	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
 	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
</div>

<script type="text/javascript">
//Set fields to their values before the page reloaded
window.onload = function(){
	var pseudo = sessionStorage.getItem('pseudo');
	if(pseudo != null) $('#pseudo').val(pseudo);
}

//Keep the fields' values in memory before reload
window.onbeforeunload = function(){
	sessionStorage.setItem('pseudo', $('#pseudo').val());
}

$( document ).ready(function(){
	//When clicking on the forgotten password link
	$('#forgottenPswd').on('click', function(){
		//Toggle the forgottent password form
		$('#pswdDiv').toggle();
	});

	//When clicking on the Send button
	$('#sendMail').on('click', function(){
		var mail = $('#email').val();

		//Send mail address to PHP to generate a new password
		var request = $.ajax({
			url: 'sources/shared/update.php',
			type: 'post',
			data: {"forgottenPswd": mail}
		});
		//When done, reload with warning message
		request.done(function(){
			window.location.replace('?page=login&forgot');
		});
	});
});
</script>