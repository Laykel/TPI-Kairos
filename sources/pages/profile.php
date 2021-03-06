<!-- 
Filename: profile.php
Description: Profile page: update form, remove account, current data.
-->

<div class="row">
  <div class="col-sm-7">

    <!-- Messages d'alerte -->
    <?php include(ROOT."/sources/shared/alerts.php");?>
    <!-- Fin des messages d'alerte -->

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Modifier vos informations de compte</h3>
        </div>
        <div class="panel-body">
            <form method="post" action="">
                <div class="form-group">
                    <label for="pseudo">Changer votre pseudonyme:</label>
                    <input type="text" class="form-control" id="pseudo" name="fPseudo" maxlength="45">
                    <small id="pseudoInstructions" class="form-text text-muted">C'est ainsi que vous êtes identifié dans l'application. Maximum 45 caractères.</small>
                </div>
                <div class="form-group">
                    <label for="pswd">Changer votre adresse mail:</label>
                    <input type="email" class="form-control" id="email" name="fEmail" maxlength="254">
                    <small id="emailInstructions" class="form-text text-muted">Cette information ne sera utilisée qu'en cas de perte de votre mot de passe.</small>
                </div>
                <div class="form-group">
                    <label for="pswd">Changer votre mot de passe:</label>
                    <input type="password" class="form-control" id="pswd" name="fPassword" maxlength="500">
                    <small id="passwordInstructions" class="form-text text-muted">Minimum 6 caractères, doit contenir au moins une majuscule, une minuscule et un chiffre.</small>
                </div>
                <div class="form-group">
                    <label for="pswd">Confirmer votre nouveau mot de passe:</label>
                    <input type="password" class="form-control" id="pswd2" name="fPassword2" maxlength="500">
                    <small id="password2Instructions" class="form-text text-muted">Doit être identique au premier.</small>
                </div>
                <button type="submit" class="btn btn-primary pull-right">Modifier les données</button>
            </form>
        </div>
    </div>
  </div>

  <div class="col-sm-5">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Vos informations actuelles</h3>
      </div>
      <div class="panel-body">
  	  <label for="pseudo">Votre pseudonyme:</label>
  	  <p id="pseudo"> <?php echo $line['user_pseudo']; ?> </p>
  	  <br>
  	  <label for="pseudo">Votre adresse mail:</label>
  	  <p id="pseudo"> <?php echo $line['user_mail']; ?> </p>
      </div>
      <div class="panel-footer" id="<?php echo $line['user_id'];?>">
        <button class="btn btn-danger" id="removeAccount">Supprimer votre compte</button>
      </div>
    </div>
  </div>
</div>

<!-- Message de confirmation -->
<?php include(ROOT."/sources/shared/modal.html");?>