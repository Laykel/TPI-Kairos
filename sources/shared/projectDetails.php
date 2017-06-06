<?php 
//----------------------------------------------------------
//Filename: projectDetails.php
//Author: Luc Wachter
//Function: This contains the details panel for the projects
//			used in both home and journal pages.
//----------------------------------------------------------

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

<!-- Display the details and the form to modify them -->
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
			<input type="text" class="form-control" id="dateCreation" name="fDateCreation" disabled="" value="<?php echo $line['project_dateCreation'];?>">
		</div>
		<div class="form-group">
			<label for="dateStart">Date de début prévue</label>
			<input type="text" class="form-control" id="dateStart" name="fDateStart" value="<?php echo $line['project_plannedBeginning'];?>">
		</div>
		<div class="form-group">
			<label for="plannedEnd">Date de fin prévue</label>
			<input type="text" class="form-control" id="plannedEnd" name="fPlannedEnd" value="<?php echo $line['project_plannedEnd'];?>">
		</div>
		<?php if($line['project_isClosed']){ ?>
			<div class="form-group">
				<label for="dateEnd">Date de fermeture</label>
				<input type="text" class="form-control" id="dateEnd" name="fDateEnd" disabled="" value="<?php echo $line['project_dateClosed'];?>">
			</div>
		<?php } else{ ?>
			<button type="submit" class="btn btn-info pull-right">Soumettre</button>
		<?php } ?>
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

<!-- If we're on journal page, disable all inputs -->
<?php if($line['project_isClosed']){ ?>
	<script type="text/javascript">
		$("#form-details :input").prop("disabled", true);
	</script>
<?php } ?>