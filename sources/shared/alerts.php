<!--
Filename: alerts.php
Description: This file contains every flash message used across
every page. It is included where needed and uses the querystring.
-->

<?php if(isset($_GET['success'])){ ?>				
	<div class="alert alert-dismissible alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Succès!</strong> Votre inscription a réussi.
	</div>
<?php }

if(isset($_GET['pswdNoMatch'])){ ?>				
	<div class="alert alert-dismissible alert-warning">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Erreur!</strong> Les deux mots de passe ne sont pas les mêmes.
	</div>
<?php }

if(isset($_GET['errorPswd'])){ ?>				
	<div class="alert alert-dismissible alert-warning">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Erreur!</strong> Veuillez utiliser un mot de passe fort. Il doit comprendre au moins 6 caractères, une majuscule, une minuscule et un chiffre.
	</div>
<?php }

if(isset($_GET['errorEmpty'])){ ?>
	<div class="alert alert-dismissible alert-warning">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Erreur!</strong> Veuillez remplir tous les champs.
	</div>
<?php }

if(isset($_GET['allEmpty'])){ ?>
	<div class="alert alert-dismissible alert-warning">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Erreur!</strong> Veuillez remplir au moins un champ.
	</div>
<?php }

if(isset($_GET['titleEmpty'])){ ?>
	<div class="alert alert-dismissible alert-warning">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Erreur!</strong> Veuillez remplir au moins le champ "Titre".
	</div>
<?php }

if(isset($_GET['errorDate'])){ ?>
	<div class="alert alert-dismissible alert-warning">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Erreur!</strong> Les dates doivent avoir le format suivant: '2017-05-30 12:15:25'.
	</div>
<?php }

if(isset($_GET['errorTime'])){ ?>
	<div class="alert alert-dismissible alert-warning">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Erreur!</strong> Le temps passé sur la tâche doit avoir le format suivant: '12:15:25'.
	</div>
<?php }

if(isset($_GET['existingEmail'])){ ?>
	<div class="alert alert-dismissible alert-warning">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Erreur!</strong> Il existe déjà un compte avec cette adresse e-mail.
	</div>
<?php }

if(isset($_GET['forgot'])){ ?>
	<div class="alert alert-dismissible alert-warning">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<p><strong>Attention!</strong> Si vous avez entré la bonne adresse e-mail, un mail vous sera envoyé dans la prochaine minute, contenant un nouveau mot de passe.</p>
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

if(isset($_GET['changeSuccess'])){ ?>
	<div class="alert alert-dismissible alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Succès!</strong> La modification des détails a réussi.
	</div>
<?php }

if(isset($_GET['profileSuccess'])){ ?>
	<div class="alert alert-dismissible alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Succès!</strong> La modification du profil a réussi.
	</div>
<?php } ?>
