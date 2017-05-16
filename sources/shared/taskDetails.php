<?php 
include("functions.php");

//Tasks
$taskReq = "SELECT project_title, task_title, task_description, task_timePassed, task_dateCreation, task_plannedBeginning, task_plannedEnd, task_dateClosed
			FROM task INNER JOIN project ON project_fk=project_id
			WHERE task_id=".$_GET['id'];
$taskRes = dbRequest($taskReq, "select");
$line = $taskRes->fetch();
?>

<div class="panel-heading">
  <h3 class="panel-title">Détails de la tâche</h3>
</div>
<div class="panel-body">
	<u><small>Appartient au projet: <?php echo $line['project_title'];?></small></u><br><br>
	<form method="post" action="">
		<div class="form-group">
			<label for="titre">Titre de la tâche</label>
			<input type="text" class="form-control" id="titre" name="fTitre" maxlength="45" value="<?php echo $line['task_title'];?>">
		</div>
		<div class="form-group">
			<label for="desc">Description</label>
			<textarea class="form-control" id="desc" rows="3" name="fDescription" maxlength="500"><?php echo $line['task_description'];?></textarea>
		</div>
		<div class="form-group">
			<label for="dateCreation">Date de création</label>
			<input type="date" class="form-control" id="dateCreation" name="fDateCreation" disabled="" value="<?php echo $line['task_dateCreation'];?>">
		</div>
		<div class="form-group">
			<label for="dateStart">Date de début prévue</label>
			<input type="date" class="form-control" id="dateStart" name="fDateStart" value="<?php echo $line['task_plannedBeginning'];?>">
		</div>
		<div class="form-group">
			<label for="timePassed">Temps passé sur la tâche</label>
			<input type="date" class="form-control" id="timePassed" name="fTimePassed" value="<?php echo $line['task_timePassed'];?>">
		</div>
		<div class="form-group">
			<label for="plannedEnd">Date de fin prévue</label>
			<input type="text" class="form-control" id="plannedEnd" name="fPlannedEnd" value="<?php echo $line['task_plannedEnd'];?>">
		</div>
		<div class="form-group">
			<label for="dateEnd">Date de fermeture</label>
			<input type="date" class="form-control" id="dateEnd" name="fDateEnd" disabled="" value="<?php echo $line['task_dateClosed'];?>">
		</div>
		<button type="submit" class="btn btn-info pull-right">Soumettre</button>
	</form>
</div>
<div class="panel-footer">
  <button type="submit" class="btn btn-danger">
  	<span class="glyphicon glyphicon-trash"></span>
  </button>
</div>