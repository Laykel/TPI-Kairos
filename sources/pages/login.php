<div class="row"><h1 class="page-title">Connexion</h1></div>

<div class="row">
	<div class="col-sm-6 col-sm-offset-3">
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
						<input type="password" class="form-control" id="pswd" name="fPassword" maxlength="200">
					</div>
					<button type="submit" class="btn btn-primary pull-right">Se connecter</button>
				</form>
				<a href="<?php echo URL;?>?page=register"><button class="btn btn-link pull-left">Page d'inscription</button></a>
			</div>
		</div>
	</div>
</div>