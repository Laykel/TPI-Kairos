<?php 
//--------------------------------------------------------
//Filename: taskDetails.php
//Author: Luc Wachter
//Function: This contains the details panel for the tasks
//			used in both home and journal pages.
//--------------------------------------------------------

include("functions.php");
include("modal.html");

//Get all task data
$taskReq = "SELECT project_title, project_isClosed, task_id, task_title, task_description, task_timePassed, task_dateCreation, task_plannedBeginning, task_plannedEnd, task_isClosed, task_dateClosed
			FROM task INNER JOIN project ON project_fk=project_id
			WHERE task_id=".$_GET['id'];
$taskRes = dbRequest($taskReq, "select");
$line = $taskRes->fetch();

//Get all comments data
$commentReq = "SELECT comment_content, comment_date FROM comment
			   WHERE task_fk=".$line['task_id'];
$commentRes = dbRequest($commentReq, "select");

$commentTab = array();
while($commentLine = $commentRes->fetch()){
	$commentTab[] = array(
		"date" => $commentLine['comment_date'],
		"content" => $commentLine['comment_content']
	);
}
?>

<div class="panel-heading">
	<h3 class="panel-title">Détails de la tâche</h3>
</div>

<!-- Display the details and the form to modify them -->
<div class="panel-body">
	<u><small>Appartient au projet: <?php echo $line['project_title'];?></small></u><br><br>
	<form method="post" action="" id="form-details">
		<input type="hidden" name="fTask" value="<?php echo $line['task_id'];?>">
		<div class="form-group">
			<label for="titre">Titre de la tâche</label>
			<input type="text" class="form-control" id="titre" name="fTitle" maxlength="100" value="<?php echo $line['task_title'];?>">
		</div>
		<div class="form-group">
			<label for="desc">Description</label>
			<textarea class="form-control" id="desc" rows="3" name="fDescription" maxlength="500"><?php echo $line['task_description'];?></textarea>
		</div>
		<div class="form-group">
			<label for="dateCreation">Date de création</label>
			<input type="text" class="form-control" id="dateCreation" name="fDateCreation" disabled="" value="<?php echo $line['task_dateCreation'];?>">
		</div>
		<div class="form-group">
			<label for="dateStart">Date de début prévue</label>
			<input type="text" class="form-control" id="dateStart" name="fDateStart" value="<?php echo $line['task_plannedBeginning'];?>">
		</div>
		<div class="form-group">
			<label for="timePassed">Temps passé sur la tâche</label>
			<input type="text" class="form-control" id="timePassed" name="fTimePassed" value="<?php echo $line['task_timePassed'];?>">
		</div>
		<div class="form-group">
			<label for="plannedEnd">Date de fin prévue</label>
			<input type="text" class="form-control" id="plannedEnd" name="fPlannedEnd" value="<?php echo $line['task_plannedEnd'];?>">
		</div>
		<?php if($line['task_isClosed']){ ?>
			<div class="form-group">
				<label for="dateEnd">Date de fermeture</label>
				<input type="text" class="form-control" id="dateEnd" name="fDateEnd" disabled="" value="<?php echo $line['task_dateClosed'];?>">
			</div>
		<?php } else{ ?>
			<div class="form-group">
				<button type="submit" class="btn btn-info pull-right">Soumettre</button>
			</div>
		<?php } ?>
	</form>

	<!-- Comments table -->
	<?php if(count($commentTab) > 0){ ?>
		<table class="table table-striped">
			<thead>
				<th>Date</th>
				<th>Commentaire</th>
			</thead>
			<tbody>
				<?php foreach ($commentTab as $comment){ ?>
					<tr>
						<td><?php echo $comment['date'];?></td>
						<td><?php echo $comment['content'];?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	<?php } ?>
</div>

<!-- Panel-footer: remove button -->
<?php if(!$line['project_isClosed']){ ?>
	<div class="panel-footer" id="<?php echo $line['task_id'];?>">
	  <button class="btn btn-danger" id="removeTask">
	  	<span class="glyphicon glyphicon-trash"></span>
	  </button>
	</div>
<?php } ?>

<!-- If we're on journal page, disable all inputs -->
<?php if($line['project_isClosed']){ ?>
	<script type="text/javascript">
		$("#form-details :input").prop("disabled", true);
	</script>
<?php } ?>