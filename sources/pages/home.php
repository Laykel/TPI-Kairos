<!-- 
Filename: home.php
Description: Projects page: Projects and tasks, timers, update details.
-->


<div class="row">
	<!-- New project button, alert messages -->
	<div class="col-sm-7">
		<!-- Alert messages -->
		<?php include(ROOT."/sources/shared/alerts.php"); ?>

		<!-- New project button -->
		<form id="newProject">
			<table class="table table-borderless table-smallmargin">
				<tr>
					<td width="20%">
						<button type="button" class="btn btn-primary" id="addProject">
							<span class="glyphicon glyphicon-plus"></span> Nouveau projet
						</button>
					</td>
					<td id="projectInput" width="70%" hidden>
						<input type="text" class="form-control" id="projectTitle" placeholder="Nouveau projet" maxlength="100">
					</td>
					<td id="projectButton" class="<?php echo $user_id;?>" width="10%" hidden>
						<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span></button>
					</td>
				</tr>
			</table>
		</form>
	</div>

	<!-- If there are projects to be shown -->
	<?php if(count($projectTab) > 0){ ?>
		<!-- Project panels with tasks, timers -->
		<div class="col-sm-7">
			<?php foreach($projectTab as $project){ 
					$totalTime = "00:00:00";
			?>
				<div class="panel <?php if($project['project_plannedEnd'] < $datetime && $project['project_plannedEnd'] != '') echo 'panel-danger'; else echo 'panel-primary';?>">
					<div class="panel-heading project-title" id="<?php echo $project['project_id'];?>">
						<h3 class="panel-title">
							<?php echo $project['project_title'];?>
							<?php if($project['project_plannedEnd'] < $datetime && $project['project_plannedEnd'] != ''){ ?>
								<span class="glyphicon glyphicon-info-sign pull-right" data-toggle="tooltip" title="Ce projet a dépassé son délai estimé!"></span>
							<?php } else{ ?>
								<span class="glyphicon glyphicon-info-sign pull-right" data-toggle="tooltip" title="Cliquez sur ce titre pour avoir accès aux détails de ce projet"></span>
							<?php } ?>
						</h3>
					</div>
					<div class="panel-body panel-no-padding">
						<div class="table-responsive">
							<table class="table table-striped table-hover table-nomargin">

								<!-- Open tasks with timer controls -->
								<?php foreach($project['task'] as $task){
										$secs = strtotime($totalTime) - strtotime("00:00:00");
										$totalTime = date("H:i:s", strtotime($task['task_timePassed']) + $secs);
										if(!$task['task_isClosed']){ 
								?>
									<tr>
										<td width="5%">
											<input type="checkbox" class="taskCB">
										</td>
										<td class="task-title" id="<?php echo $task['task_id']; ?>" width="70%">
											<?php echo $task['task_title'];?>
										</td>
										<td width="5%">
											<?php if($task['task_plannedEnd'] < $datetime && $task['task_plannedEnd'] != '') echo "<span class='glyphicon glyphicon-time pull-right' data-toggle='tooltip' title='Cette tâche a dépassé son délai estimé'></span>";
												else echo "<span class='glyphicon glyphicon-info-sign pull-right' data-toggle='tooltip' title='Cliquez sur ce titre pour avoir accès aux détails de cette tâche'></span>"; 
											?>
										</td>
										<td width="10%" disabled>
											<button class="btn btn-primary btn-xs timerPlay" id="<?php echo $task['task_id'];?>">
												<span class="glyphicon glyphicon-play"></span>
											</button>
										</td>
										<td width="10%" hidden="">
											<button class="btn btn-primary btn-xs timerPause" id="<?php echo $task['task_id'];?>">
												<span class="glyphicon glyphicon-pause"></span>
											</button>
										</td>
										<td id="timer" width="10%">
											<p class="timeDB"><?php echo $task['task_timePassed']; ?></p>
											<p class="timeTimer" hidden=""><span class="sw_h<?php echo $task['task_id']; ?>">00</span>:<span class="sw_m<?php echo $task['task_id']; ?>">00</span>:<span class="sw_s<?php echo $task['task_id']; ?>">00</span></p>
										</td>
									</tr>
								<?php } } ?>

								<!-- New task form -->
								<form class="newTask" name="<?php echo $project['project_id'];?>">
									<tr>
										<td colspan="4">
											<input type="text" class="form-control newTaskTitle<?php echo $project['project_id'];?>" placeholder="Nouvelle tâche" maxlength="100">
										</td>
										<td width="15%">
											<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span></button>
										</td>
									</tr>
								</form>

								<!-- Closed tasks -->
								<?php foreach($project['task'] as $task){ 
										if($task['task_isClosed']){ ?>
									<tr>
										<td id="<?php echo $task['task_id']; ?>" width="5%">
											<input type="checkbox" class="taskCBClosed" checked="">
										</td>
										<td class="task-title" id="<?php echo $task['task_id']; ?>" colspan="2" width="70%">
											<p><?php echo " ".$task['task_title']; ?></p>
										</td>
										<td>
											<span class='glyphicon glyphicon-info-sign pull-right' data-toggle='tooltip' title='Cliquez sur ce titre pour avoir accès aux détails de cette tâche'></span>
										</td>
										<td width="10%">
											<p><?php echo $task['task_timePassed']; ?></p>
										</td>
									</tr>
								<?php } } ?>
							</table>
						</div>
					</div>

					<!-- Total time for the project -->
					<div class="panel-footer">
					<p>Total du temps passé sur ce projet: <?php echo $totalTime;?></p>
					</div>
				</div>
			<?php } ?>
		</div>

		<!-- Controls for the timers -->
		<input type="button" id="sw_start" hidden=""/>
	    <input type="button" id="sw_pause" hidden=""/>
	    <input type="button" id="sw_reset" hidden=""/>

	    <!-- Project and task info panel (loaded through ajax) -->
	    <div id="details-top"></div>
		<div class="col-sm-5">
			<div class="panel panel-info" id="panel-details"></div>
		</div>
		<!-- Comment modal -->
		<div class="modal fade" id="comment-modal">
			<div class="modal-dialog">
				<div class="modal-content">
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">Ajouter un commentaire</h4>
					</div>

					<!-- Modal Body -->
					<div class="modal-body">
						<p>Un nouveau timer vient de commencer. Lorsque vous appuierez sur le bouton "Pause", le temps de ce dernier s'ajoutera au temps total passé sur cette tâche.</p>
						<p>Vous pouvez ajouter un commentaire pour décrire cette session. Si vous ne voulez pas, appuyez sur "Non".</p>
						<div class="form-group">
							<label for="fComment">Commentaire:</label>
							<textarea class="form-control" id="commentTask" rows="3" name="fComment" maxlength="200"></textarea>
						</div>
					</div>

					<!-- Modal Footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
						<button type="button" class="btn btn-primary" data-dismiss="modal" id="yes">Sauvegarder</button>
					</div>
				</div>
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
						<p>Il semble que vous n'ayez pas encore créé de projets, ou que vous les ayez tous fermés.</p>
						<p>Pour créer un nouveau projet, il vous suffit d'appuyer sur le bouton "Nouveau projet" ci-dessus, d'entrer un nom et de cliquer sur le vu!</p>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</div>

<script type="text/javascript" src="<?php echo ROOT;?>/assets/js/dbUpdate.js"></script>
<script type="text/javascript">
$( document ).ready(function() {

	//Toggle new project form
	$('#addProject').on('click', function(e){
		$('#projectInput').toggle();
		$('#projectButton').toggle();
	});

	//Adds a new task to DB
	$('.newTask').on('submit', function(e){
		e.preventDefault(); //Don't POST
		var projectId = $(this).prop('name');
		var title = $('.newTaskTitle'+projectId).val();

		if(title == '') title = "Nouvelle tâche";

		//Send projectID and title to PHP to insert task in DB
		var request = $.ajax({
			url: 'sources/shared/update.php',
			type: 'post',
			data: {"addTask": projectId, "title": title}
		});
		//When done, reload page
		request.done(function(){
			window.location.reload();
		});
	});

	//Adds a new project to DB
	$('#newProject').on('submit', function(e){
		e.preventDefault(); //Don't POST
		var title = $('#projectTitle').val();
		var user = $('#projectButton').prop('class');

		if(title == '') title = "Nouveau projet";

		//Send userID and title to PHP to insert in DB
		var request = $.ajax({
			url: 'sources/shared/update.php',
			type: 'post',
			data: {"addProject": title, "user": user}
		});
		//When done, reload page
		request.done(function(){
			window.location.reload();
		});
	});

	//When play button is clicked
	$('.timerPlay').on('click', function(e){
		//Get the task's id
		var id = $(this).prop('id');

		//Invoke the modal to ask the user whether
		//he wants to add a comment
		$('#comment-modal').modal({
			backdrop: 'static',
			keyboard: false
		})
		.one('click', '#yes', function(e){
			//Get comment
			var comment = $('#commentTask').val();

			//Call PHP to add comment to DB
			var request = $.ajax({
				url: 'sources/shared/update.php',
				type: 'post',
				data: {"addComment": comment, "id": id}
			});
		});

		//Hide the time from the DB and show the timer
		$('.sw_h'+id).closest('p').show();
		$('.sw_h'+id).closest('p').prev('p').hide();

		//Disable all play buttons: one timer at a time
		$('.timerPlay').prop("disabled", true);

		//Apply the ids that will allow the timer to run
		$('.sw_h'+id).prop('id', 'sw_h');
		$('.sw_m'+id).prop('id', 'sw_m');
		$('.sw_s'+id).prop('id', 'sw_s');

		//Hide the play button and show the pause button
		$(this).closest('td').hide();
		$(this).closest('td').next('td').show();

		//Trigger the event and the timer
		$("#sw_start").trigger("click");
	});

	//When pause button is clicked
	$('.timerPause').on('click', function(e){
		//Re-activate all play buttons
		$('.timerPlay').prop("disabled", false);

		//Hide the pause button and show the play button
		$(this).closest('td').hide();
		$(this).closest('td').prev('td').show();

		//Get the task's id
		var id = $(this).prop('id');

		//Get the timer's value to put it in the DB
		var time = $('.sw_h'+id).html() + ':' + $('.sw_m'+id).html() + ':' + $('.sw_s'+id).html();

		//Update the DB with the new time
		var request = $.ajax({
			url: 'sources/shared/update.php',
			type: 'post',
			data: {"updateTime": time, "id": id}
		});

		request.done(function(){
			window.location.reload();

			//Trigger the pause of the timer and reset
			$("#sw_pause").trigger("click");
			$("#sw_reset").trigger("click");

			//Remove the ids that allow the timer to run
			$('.sw_h'+id).prop('id', '');
			$('.sw_m'+id).prop('id', '');
			$('.sw_s'+id).prop('id', '');
		});
	});
});
</script>