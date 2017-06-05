<!-- 
Filename: journal.php
Description: Journal page: closed projects, reopen button.
-->

<!-- If there are projects to be shown -->
<?php if(count($projectTab) > 0){ ?>
	<div class="row">
		<!-- Closed projects panels with tasks -->
		<div class="col-sm-7">
		  <?php foreach($projectTab as $project){ 
		  			$totalTime = "00:00:00";
		  ?>
			  <div class="panel panel-primary panel-closed">
			    <div class="panel-heading project-title" id="<?php echo $project['project_id'];?>">
			      <h3 class="panel-title">
			      	<?php echo $project['project_title'];?>
			   	  </h3>
			    </div>
			    <div class="panel-body panel-no-padding">
					<table class="table">
						<!-- Open tasks -->
						<?php foreach($project['task'] as $task){ 
								$secs = strtotime($totalTime) - strtotime("00:00:00");
								$totalTime = date("H:i:s", strtotime($task['task_timePassed']) + $secs);
								if(!$task['task_isClosed']){ 
						?>
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

						<!-- Closed tasks -->
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
			      <p>Total du temps passé sur ce projet: <?php echo $totalTime;?></p>
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
<?php } else{ ?>
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Vous n'avez pas encore de projets dans cette vue</h3>
				</div>

				<div class="panel-body">
					<p>Il semble que vous n'ayez pas encore de projets fermés.</p>
					<p>Pour fermer un projet, cliquez sur son titre puis sur le bouton "Fermer" tout en bas de ses détails.</p>
				</div>
			</div>
		</div>
	</div>
<?php } ?>