<div class="row"><h1 class="page-title">Inscription</h1></div>

<div class="row">
	<div class="col-sm-6 col-sm-offset-3">

	    <!-- Messages d'alerte -->
	    <?php include(ROOT."/sources/shared/alerts.php"); ?>
	    <!-- Fin des messages d'alerte -->

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Créez votre compte</h3>
			</div>

			<div class="panel-body">
				<form method="post" action="">
					<div class="form-group">
						<label for="pseudo">Votre pseudonyme</label>
						<input type="text" class="form-control" id="pseudo" name="fPseudo" maxlength="45">
						<small id="pseudoInstructions" class="form-text text-muted">C'est ainsi que vous serez identifié dans l'application.</small>
					</div>
					<div class="form-group">
						<label for="email">Votre adresse e-mail</label>
						<input type="email" class="form-control" id="email" name="fEmail" placeholder="exemple@test.ch" maxlength="254">
					</div>
					<div class="form-group">
						<label for="pswd">Votre mot de passe</label>
						<input type="password" class="form-control" id="pswd" name="fPassword" maxlength="500">
					</div>
					<div class="form-group">
						<label for="pswd2">Confirmez votre mot de passe</label>
						<input type="password" class="form-control" id="pswd2" name="fPassword2" maxlength="500">
					</div>
					<button type="submit" class="btn btn-primary pull-right">S'inscrire</button>
				</form>
				<a href="<?php echo URL;?>?page=login"><button class="btn btn-link pull-left">Page de connexion</button></a>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
window.onload = function(){
	var email = sessionStorage.getItem('email');
	if(email != null) $('#email').val(email);
	var pseudo = sessionStorage.getItem('pseudo');
	if(pseudo != null) $('#pseudo').val(pseudo);
}

window.onbeforeunload = function(){
	sessionStorage.setItem('email', $('#email').val());
	sessionStorage.setItem('pseudo', $('#pseudo').val());
}
</script>