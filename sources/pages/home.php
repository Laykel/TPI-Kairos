<div class="row">
	<div class="col-sm-7">
		<!-- Messages d'alerte -->
		<?php include(ROOT."/sources/shared/alerts.php"); ?>
		<!-- Fin des messages d'alerte -->

		<form id="newProject">
			<table class="table table-borderless table-nomargin">
				<tr>
					<td width="20%">
						<button type="button" class="btn btn-primary" id="addProject">
							<span class="glyphicon glyphicon-plus"></span> Nouveau projet
						</button>
					</td>
					<td id="projectInput" width="70%" hidden>
						<input type="text" class="form-control" id="projectTitle" placeholder="Nouveau projet">
					</td>
					<td id="projectButton" width="10%" hidden>
						<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span></button>
					</td>
				</tr>
			</table>
		</form>
	</div>
	<div class="col-sm-7">
		<?php foreach($projectTab as $project){ ?>
			<div class="panel panel-primary">
				<div class="panel-heading project-title" id="<?php echo $project['project_id'];?>">
					<h3 class="panel-title">
						<?php echo $project['project_title'];?>
						<span class="glyphicon glyphicon-info-sign pull-right"></span>
					</h3>
				</div>
				<div class="panel-body panel-no-padding">
					<table class="table table-striped table-hover table-nomargin">
						<?php foreach($project['task'] as $task){
								if(!$task['task_isClosed']){ ?>
							<tr>
								<td width="5%">
									<input type="checkbox" class="taskCB">
								</td>
								<td class="task-title" id="<?php echo $task['task_id']; ?>" width="70%">
									<?php echo $task['task_title'];?>
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
								<td id="timer" width="15%">
									<p class="timeDB"><?php echo $task['task_timePassed']; ?></p>
									<p class="timeTimer" hidden=""><span class="sw_h<?php echo $task['task_id']; ?>">00</span>:<span class="sw_m<?php echo $task['task_id']; ?>">00</span>:<span class="sw_s<?php echo $task['task_id']; ?>">00</span></p>
								</td>
							</tr>
						<?php } } ?>
						<form class="newTask" name="<?php echo $project['project_id'];?>">
							<tr>
								<td colspan="3">
									<input type="text" class="form-control newTaskTitle<?php echo $project['project_id'];?>" placeholder="Nouvelle tâche" maxlength="100">
								</td>
								<td>
									<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span></button>
								</td>
							</tr>
						</form>
						<?php foreach($project['task'] as $task){ 
								if($task['task_isClosed']){ ?>
							<tr>
								<td id="<?php echo $task['task_id']; ?>">
									<input type="checkbox" class="taskCBClosed" checked="">
								</td>
								<td class="task-title" id="<?php echo $task['task_id']; ?>">
									<?php echo " ".$task['task_title']; ?>
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
	<input type="button" id="sw_start" hidden=""/>
    <input type="button" id="sw_pause" hidden=""/>
    <input type="button" id="sw_reset" hidden=""/>
    <div id="details-top"></div>
	<div class="col-sm-5">
		<div class="panel panel-info fixed" id="panel-details"></div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="comment-modal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">
					Modal title
				</h4>
			</div>

			<!-- Modal Body -->
			<div class="modal-body">
				<form role="form">
					<div class="form-group">
						<label for="exampleInputEmail1">Email address</label>
						<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"/>
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Password</label>
						<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"/>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox"/> Check me out
						</label>
					</div>
					<button type="submit" class="btn btn-default">Submit</button>
				</form>
			</div>

			<!-- Modal Footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal" id="yes">Sauvegarder</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo ROOT;?>/assets/js/dbUpdate.js"></script>
<script type="text/javascript">

	$('#addProject').on('click', function(e){
		$('#projectInput').toggle();
		$('#projectButton').toggle();
	});

	$('.newTask').on('submit', function(e){
		e.preventDefault();
		var projectId = $(this).prop('name');
		var title = $('.newTaskTitle'+projectId).val();

		var request = $.ajax({
			url: 'sources/shared/update.php',
			type: 'post',
			data: {"addTask": projectId, "title": title}
		});

		request.done(function(){
			$('.taskTitle'+projectId).val('');
			window.location.reload();
		});
	});

	$('#newProject').on('submit', function(e){
		e.preventDefault();
		var title = $('#projectTitle').val();

		var request = $.ajax({
			url: 'sources/shared/update.php',
			type: 'post',
			data: {"addProject": 1, "title": title}
		});

		request.done(function(){
			window.location.reload();
		});
	});
</script>