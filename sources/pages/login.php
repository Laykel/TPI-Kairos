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
<hr>

<!-- Site description -->
<div class="row">
	<div class="col-sm-6 col-sm-offset-3">

		<h2>Description du site</h2>
		<h3>Kairos projects</h3>
		<p>Kairos est un site de gestion de tâche, avec un accent sur la gestion du temps.</p>
		<br>
		<p>Il est souvent important de savoir combien de temps on a passé sur tel ou tel élément d'un projet. <br>
		Ce serait superbe de pouvoir planifier ses tâches et d'avoir en même temps une sorte de journal de travail automatique.</p>
		<br>

		<h3>La structure</h3>
		<p>Kairos est construit pour être compris par tout le monde. Vous pouvez créer des projets, et dans ces projets, vous pouvez créer des tâches.</p>
		<br>
		<p>Chaque projet et chaque tâche a un certain nombre de paramètres supplémentaires qu'on peut remplir.</p>
		<ul>
			<li>Une description en plus du titre</li>
			<li>La date prévue de commencement du projet/de la tâche</li>
			<li>La date prévue de fin du projet/de la tâche</li>
			<li>Dans le cas des tâches, le temps total passé dessus</li>
			<li>Dans le cas des tâches, les commentaires entrés à chaque début de timer</li>
		</ul>
 	</div>
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