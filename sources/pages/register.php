<div class="row"><h1 class="page-title">Inscription</h1></div>

<div class="row">
	<div class="col-sm-6 col-sm-offset-3">

		<!-- Messages d'alerte PEUT-ETRE RENDRE CA COMMUN -->
		<?php if(isset($_GET['info'])){ ?>

			<?php if($_GET['info'] == 'errorPswd'){ ?>				
				<div class="alert alert-dismissible alert-warning">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Erreur!</strong> Les deux mots de passe ne sont pas les mêmes.
				</div>
			<?php }
			elseif ($_GET['info'] == 'errorEmpty') { ?>
				<div class="alert alert-dismissible alert-warning">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Erreur!</strong> Veuillez remplir tous les champs.
				</div>
			<?php }
			elseif ($_GET['info'] == 'existingEmail') { ?>
				<div class="alert alert-dismissible alert-warning">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Erreur!</strong> Il existe déjà un compte avec cette adresse e-mail.
				</div>
			<?php }
			elseif ($_GET['info'] == 'existingPseudo') { ?>
				<div class="alert alert-dismissible alert-warning">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Erreur!</strong> Il existe déjà un compte avec ce pseudonyme.
				</div>
			<?php } ?>
		<?php } ?>
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
						<input type="email" class="form-control" id="email" name="fEmail" placeholder="exemple@test.ch" maxlength="254"></textarea>
					</div>
					<div class="form-group">
						<label for="pswd">Votre mot de passe</label>
						<input type="password" class="form-control" id="pswd" name="fPassword" maxlength="200">
					</div>
					<div class="form-group">
						<label for="pswd2">Confirmez votre mot de passe</label>
						<input type="password" class="form-control" id="pswd2" name="fPassword2" maxlength="200">
					</div>
					<button type="submit" class="btn btn-primary pull-right">S'inscrire</button>
				</form>
				<a href="<?php echo URL;?>?page=login"><button class="btn btn-link pull-left">Page de connexion</button></a>
			</div>
		</div>
	</div>
</div>