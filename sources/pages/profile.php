<div class="row">
  <div class="col-sm-7">

    <!-- Messages d'alerte -->
    <?php include(ROOT."/sources/shared/alerts.php"); ?>
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
  		</div>
  		<div class="form-group">
  		  <label for="pswd">Changer votre adresse mail:</label>
  		  <input type="email" class="form-control" id="email" name="fEmail" maxlength="254">
  		</div>
  		<div class="form-group">
  		  <label for="pswd">Changer votre mot de passe:</label>
  		  <input type="password" class="form-control" id="pswd" name="fPassword" maxlength="200">
  		  <label for="pswd">Confirmer votre nouveau mot de passe:</label>
  		  <input type="password" class="form-control" id="pswd2" name="fPassword2" maxlength="200">
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
      <div class="panel-footer">
        <form method="post" action="">
          <input type="hidden" name="fDeleteAccount">
          <button type="submit" class="btn btn-danger">Supprimer votre compte</button>
        </form>
      </div>
    </div>
  </div>
</div>