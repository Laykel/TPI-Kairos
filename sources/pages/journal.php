<div class="row">

	<!-- Closed projects panels with tasks -->
	<div class="col-sm-7">
	  <?php foreach($projectTab as $project){ ?>
		  <div class="panel panel-primary panel-closed">
		    <div class="panel-heading project-title" id="<?php echo $project['project_id'];?>">
		      <h3 class="panel-title">
		      	<?php echo $project['project_title'];?>
		   	  </h3>
		    </div>
		    <div class="panel-body panel-no-padding">
				<table class="table">
					<?php foreach($project['task'] as $task){ 
							if(!$task['task_isClosed']){ ?>
						<tr>
							<td width="5%">
								<input type="checkbox" disabled="">
							</td>
							<td  class="task-title" id="<?php echo $task['task_id']; ?>" width="80%">
								<?php echo $task['task_title']; ?>
							</td>
							<td width="15%">
								<?php echo $task['task_timePassed']; ?>
							</td>
						</tr>
					<?php } } ?>
					<?php foreach($project['task'] as $task){ 
							if($task['task_isClosed']){ ?>
						<tr>
							<td width="5%">
								<input type="checkbox" checked="" disabled="">
							</td>
							<td class="task-title" id="<?php echo $task['task_id']; ?>" width="80%">
								<p><?php echo $task['task_title']; ?></p>
							</td>
							<td width="15%">
								<p><?php echo $task['task_timePassed']; ?></p>
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
	
    <!-- Project and task info panel -->
	<div id="details-top"></div>
	<div class="col-sm-5">
		<div class="panel panel-info panel-closed" id="panel-details"></div>
	</div>
</div>