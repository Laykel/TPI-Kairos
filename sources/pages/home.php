<div class="row">
	<div class="col-sm-7">

	  <!-- Messages d'alerte -->
	  <?php include(ROOT."/sources/shared/alerts.php"); ?>
	  <!-- Fin des messages d'alerte -->

	  <button type="submit" class="btn btn-primary">
	  	<span class="glyphicon glyphicon-plus"></span> Nouveau projet
	  </button>
	  <br><br>

	  <?php foreach($projectTab as $project){ ?>
		  <div class="panel panel-primary">
		    <div class="panel-heading">
		      <h3 class="panel-title"><?php echo $project['project_title'];?></h3>
		    </div>
		    <div class="panel-body">
		      <?php foreach($project['task'] as $task){ ?>
			      <div class="container">
			      	<div class="col-sm-5">
			      		<input type="checkbox" name="yo"><?php echo $task['task_title']; ?>
			      	</div>
			      	<div class="col-sm-2">
			      		<?php	echo $task['task_timePassed']; ?>
			      	</div>
			      </div>
		      <?php } ?>
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
				<form method="post" action="">
					<div class="form-group">
						<label for="titre">Titre du projet</label>
						<input type="text" class="form-control" id="titre" name="fTitre" maxlength="45">
					</div>
					<div class="form-group">
						<label for="desc">Description</label>
						<textarea class="form-control" id="desc" rows="3" name="fDescription" maxlength="500"></textarea>
					</div>
					<div class="form-group">
						<label for="dateCreation">Date de création</label>
						<input type="date" class="form-control" id="dateCreation" name="fDateCreation">
					</div>
					<div class="form-group">
						<label for="dateStart">Date de début prévue</label>
						<input type="date" class="form-control" id="dateStart" name="fDateStart">
					</div>
					<div class="form-group">
						<label for="dateEnd">Date de fin prévue</label>
						<input type="date" class="form-control" id="dateEnd" name="fDateEnd">
					</div>
					<button type="submit" class="btn btn-info pull-right">Soumettre</button>
				</form>
	    </div>
	    <div class="panel-footer">
	    	<button type="submit" class="btn btn-default">Fermer</button>
	      <button type="submit" class="btn btn-danger pull-right">
	      	<span class="glyphicon glyphicon-trash"></span>
	      </button>
	    </div>
	  </div>
	</div>
</div>