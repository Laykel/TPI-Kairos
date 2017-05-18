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
				<div class="panel-heading project-title" id="<?php echo $project['project_id'];?>">
					<h3 class="panel-title">
						<?php echo $project['project_title'];?>
						<!--<small class="pull-right">Fin prévue: <?php //echo $project['project_plannedEnd'];?></small>-->
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
									<span class="glyphicon glyphicon-play"></span>
									<span class="glyphicon glyphicon-pause"></span>
								</td>
								<td>
									<?php echo $task['task_timePassed']; ?>
								</td>
							</tr>
						<?php } } ?>
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