<?php if(isset($_GET['success'])){ ?>				
	<div class="alert alert-dismissible alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Succès!</strong> Votre inscription a réussi.
	</div>
<?php }

if(isset($_GET['errorPswd'])){ ?>				
	<div class="alert alert-dismissible alert-warning">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Erreur!</strong> Les deux mots de passe ne sont pas les mêmes.
	</div>
<?php }

if(isset($_GET['errorEmpty'])){ ?>
	<div class="alert alert-dismissible alert-warning">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Erreur!</strong> Veuillez remplir tous les champs.
	</div>
<?php }

if(isset($_GET['existingEmail'])){ ?>
	<div class="alert alert-dismissible alert-warning">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Erreur!</strong> Il existe déjà un compte avec cette adresse e-mail.
	</div>
<?php }

if(isset($_GET['existingPseudo'])){ ?>
	<div class="alert alert-dismissible alert-warning">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Erreur!</strong> Il existe déjà un compte avec ce pseudonyme.
	</div>
<?php }

if(isset($_GET['errorCo'])){ ?>
	<div class="alert alert-dismissible alert-warning">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Attention!</strong> Pseudonyme et/ou mot de passe incorrect(s).
	</div>
<?php } 

if(isset($_GET['profileSuccess'])){ ?>
	<div class="alert alert-dismissible alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Attention!</strong> La modification du profil a réussi.
	</div>
<?php } ?>