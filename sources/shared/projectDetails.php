<?php 
include("functions.php");
include("modal.html");

//Get all project data
$projectReq = "SELECT project_id, project_title, project_description, project_dateCreation, project_plannedBeginning, project_plannedEnd, project_dateClosed, project_isClosed
			   FROM project WHERE project_id=".$_GET['id'];
$projectRes = dbRequest($projectReq, "select");
$line = $projectRes->fetch();
$journal = true;
?>

<div class="panel-heading">
	<h3 class="panel-title">Détails du projet</h3>
</div>
<div class="panel-body">
	<form method="post" action="" id="form-details">
		<input type="hidden" name="fProject" value="<?php echo $line['project_id'];?>">
		<div class="form-group">
			<label for="titre">Titre du projet</label>
			<input type="text" class="form-control" id="titre" name="fTitle" maxlength="100" value="<?php echo $line['project_title'];?>">
		</div>
		<div class="form-group">
			<label for="desc">Description</label>
			<textarea class="form-control" id="desc" rows="3" name="fDescription" maxlength="500"><?php echo $line['project_description'];?></textarea>
		</div>
		<div class="form-group">
			<label for="dateCreation">Date de création</label>
			<input type="datetime" class="form-control" id="dateCreation" name="fDateCreation" disabled="" value="<?php echo $line['project_dateCreation'];?>">
		</div>
		<div class="form-group">
			<label for="dateStart">Date de début prévue</label>
			<input type="datetime" class="form-control" id="dateStart" name="fDateStart" value="<?php echo $line['project_plannedBeginning'];?>">
		</div>
		<div class="form-group">
			<label for="plannedEnd">Date de fin prévue</label>
			<input type="datetime" class="form-control" id="plannedEnd" name="fPlannedEnd" value="<?php echo $line['project_plannedEnd'];?>">
		</div>
		<div class="form-group">
			<label for="dateEnd">Date de fermeture</label>
			<input type="datetime" class="form-control" id="dateEnd" name="fDateEnd" disabled="" value="<?php echo $line['project_dateClosed'];?>">
		</div>
		<?php if(!$line['project_isClosed']){ ?>
			<button type="submit" class="btn btn-info pull-right">Soumettre</button>
		<?php $journal = false; } ?>
	</form> 
</div>

<!-- Footer: Close and delete buttons -->
<div class="panel-footer" id="<?php echo $line['project_id'];?>">
	<?php if(!$line['project_isClosed']){ ?>
		<button class="btn btn-default" id="close">Fermer</button>
		<button class="btn btn-danger pull-right" id="removeProject">
			<span class="glyphicon glyphicon-trash"></span>
		</button>
	<?php } else{ ?>
		<button class="btn btn-default" id="reopen">Rouvrir le projet</button>
	<?php } ?>
</div>

<?php
if($journal) echo '<script type="text/javascript">
	$("#form-details :input").prop("disabled", true);
</script>';
?>