<?php 
include("functions.php");

//Projects
$projectReq = "SELECT project_title, project_description, project_dateCreation, project_plannedBeginning, project_plannedEnd, project_dateClosed, project_isClosed
			   FROM project WHERE project_id=".$_GET['id'];
$projectRes = dbRequest($projectReq, "select");
$line = $projectRes->fetch();

?>

<div class="panel-heading">
  <h3 class="panel-title">Détails du projet</h3>
</div>
<div class="panel-body">
	<form method="post" action="">
		<div class="form-group">
			<label for="titre">Titre du projet</label>
			<input type="text" class="form-control" id="titre" name="fTitre" maxlength="45" value="<?php echo $line['project_title'];?>">
		</div>
		<div class="form-group">
			<label for="desc">Description</label>
			<textarea class="form-control" id="desc" rows="3" name="fDescription" maxlength="500"><?php echo $line['project_description'];?></textarea>
		</div>
		<div class="form-group">
			<label for="dateCreation">Date de création</label>
			<input type="date" class="form-control" id="dateCreation" name="fDateCreation" disabled="" value="<?php echo $line['project_dateCreation'];?>">
		</div>
		<div class="form-group">
			<label for="dateStart">Date de début prévue</label>
			<input type="date" class="form-control" id="dateStart" name="fDateStart" value="<?php echo $line['project_plannedBeginning'];?>">
		</div>
		<div class="form-group">
			<label for="plannedEnd">Date de fin prévue</label>
			<input type="date" class="form-control" id="plannedEnd" name="fPlannedEnd" value="<?php echo $line['project_plannedEnd'];?>">
		</div>
		<div class="form-group">
			<label for="dateEnd">Date de fermeture</label>
			<input type="date" class="form-control" id="dateEnd" name="fDateEnd" disabled="" value="<?php echo $line['project_dateClosed'];?>">
		</div>
		<?php if(!$line['project_isClosed']){ ?>
			<button type="submit" class="btn btn-info pull-right">Soumettre</button>
		<?php } ?>
	</form>
</div>
<div class="panel-footer">
	<?php if(!$line['project_isClosed']){ ?>
		<button type="submit" class="btn btn-default">Fermer</button>
		<button type="submit" class="btn btn-danger pull-right">
			<span class="glyphicon glyphicon-trash"></span>
		</button>
	<?php } else{ ?>
		<button type="submit" class="btn btn-default">Rouvrir le projet</button>
	<?php } ?>
</div>