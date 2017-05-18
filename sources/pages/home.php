<div class="row">
	<div class="col-sm-7">
		<!-- Messages d'alerte -->
		<?php include(ROOT."/sources/shared/alerts.php"); ?>
		<!-- Fin des messages d'alerte -->

		<button class="btn btn-primary" id="addProject">
			<span class="glyphicon glyphicon-plus"></span> Nouveau projet
		</button>
		<br><br>

		<?php foreach($projectTab as $project){ ?>
			<div class="panel panel-primary">
				<div class="panel-heading project-title" id="<?php echo $project['project_id'];?>">
					<h3 class="panel-title">
						<?php echo $project['project_title'];?>
						<span class="glyphicon glyphicon-info-sign pull-right"></span>
					</h3>
				</div>
				<div class="panel-body">
					<table class="table table-striped table-hover">
						<?php foreach($project['task'] as $task){
								if(!$task['task_isClosed']){ ?>
							<tr>
								<td class="task-title" id="<?php echo $task['task_id']; ?>">
									<input type="checkbox"><?php echo " ".$task['task_title']; ?>
								</td>
								<td>
									<button class="btn btn-primary btn-xs">
										<span class="glyphicon glyphicon-play"></span>
									</button>
									<!--<span class="glyphicon glyphicon-pause"></span>-->
								</td>
								<td>
									<?php echo $task['task_timePassed']; ?>
								</td>
							</tr>
						<?php } } ?>
						<form name="<?php echo $project['project_id'];?>" class="newTask">
							<tr>
								<td colspan="2">
									<input type="text" class="form-control taskInput" placeholder="Nouvelle tâche">
								</td>
								<td>
									<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span></button>
								</td>
							</tr>
						</form>
						<?php foreach($project['task'] as $task){ 
								if($task['task_isClosed']){ ?>
							<tr>
								<td class="task-title" id="<?php echo $task['task_id']; ?>">
									<input type="checkbox" checked=""><?php echo " ".$task['task_title']; ?>
								</td>
								<td></td>
								<td>
									<?php echo $task['task_timePassed']; ?>
								</td>
							</tr>
						<?php } } ?>
					</table>
				</div>
				<div class="panel-footer">
					<p>Total du temps passé: ...</p>
				</div>
			</div>
		<?php } ?>
	</div>

	<div class="col-sm-5">
		<div class="panel panel-info fixed" id="panel-details">

		</div>
	</div>
</div>

<script type="text/javascript">
$('.newTask').on('submit', function(e){
	e.preventDefault();
	var projectId = $(this).prop('name');
	var title = $(this).closest('input.taskInput').val();
	
	var request = $.ajax({
	  url: 'sources/shared/update.php',
	  type: 'post',
	  data: {"add-task": projectId, "title": title}
	});

	request.done(function(){
	  window.location.reload();
	});
});
</script>