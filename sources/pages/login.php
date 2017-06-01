<div class="row"><h1 class="page-title">Connexion</h1></div>

<!-- Formulaire de connexion -->
<div class="row">
	<div class="col-sm-6 col-sm-offset-3">

	    <!-- Messages d'alerte -->
	    <?php include(ROOT."/sources/shared/alerts.php"); ?>
	    <!-- Fin des messages d'alerte -->

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
<!-- Fin de formulaire de connexion -->
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