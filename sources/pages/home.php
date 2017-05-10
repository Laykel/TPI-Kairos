<div class="col-sm-7">

  <!-- Messages d'alerte -->
  <?php include(ROOT."/sources/shared/alerts.php"); ?>
  <!-- Fin des messages d'alerte -->

  <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Nouveau projet</button> <br><br>

  <?php foreach($projectTab as $project){ ?>
	  <div class="panel panel-primary">
	    <div class="panel-heading">
	      <h3 class="panel-title"><?php echo $project['project_title'];?></h3>
	    </div>
	    <div class="panel-body">
	      <?php 
	      	foreach($project['task'] as $task){
	      		echo $task['task_title'];
	      	}
	      ?>
	    </div>
	    <div class="panel-footer">
	      <p>Total du temps passé: ...</p>
	    </div>
	  </div>
  <?php } ?>
</div>

<div class="col-sm-5">
  <div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title">Détails du projet</h3>
    </div>
    <div class="panel-body">
      <form class="form-horizontal">
        <fieldset>
          <div class="form-group">
            <label for="inputTitre" class="col-lg-12 control-label">Titre du projet</label>
            <div class="col-lg-12">
              <input class="form-control" id="inputTitre" placeholder="Projet numéro 1" type="text">
            </div>
          </div>
          <div class="form-group">
            <label for="inputDesc" class="col-lg-12 control-label">Description</label>
            <div class="col-lg-12">
              <textarea class="form-control" rows="3" id="inputDesc"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputTitre" class="col-lg-12 control-label">Date de création</label>
            <div class="col-lg-12">
              <input class="form-control" id="inputTitre" placeholder="" type="text" disabled="">
            </div>
          </div>
          <div class="form-group">
            <label for="inputTitre" class="col-lg-12 control-label">Date de début prévue</label>
            <div class="col-lg-12">
              <input class="form-control" id="inputTitre" placeholder="" type="date">
            </div>
          </div>
          <div class="form-group">
            <label for="inputTitre" class="col-lg-12 control-label">Date de fin prévue</label>
            <div class="col-lg-12">
              <input class="form-control" id="inputTitre" placeholder="" type="text">
            </div>
          </div>
          <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
              <button type="submit" class="btn btn-info pull-right">Soumettre</button>
            </div>
          </div>
        </fieldset>
      </form>
      <hr>
      <form>
        <button type="submit" class="btn btn-default">Fermer</button>
        <button type="submit" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-trash"></span></button>
      </form>
    </div>
  </div>
</div>