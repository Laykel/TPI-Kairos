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
		    <div class="panel-heading">
		      <h3 class="panel-title project-title"><?php echo $project['project_title'];?></h3>
		    </div>
		    <div class="panel-body">
		      <?php foreach($project['task'] as $task){ ?>
			      <div class="container">
			      	<div class="col-sm-5">
			      		<input type="checkbox" name="isClosed"><?php echo " ".$task['task_title']; ?>
			      	</div>
			      	<div class="col-sm-2">
			      		<?php	echo $task['task_timePassed']; ?>
			      	</div>
			      </div>
		      <?php } ?>
		    </div>
		    <div class="panel-footer">
		      <p>Total du temps passé: ...</p>
		    </div>
		  </div>
	  <?php } ?>
	</div>

	<div class="col-sm-5">
	  <div class="panel panel-info">
	    
	  </div>
	</div>
</div>

<script type="text/javascript">
	$('.project-title').on('click', )
</script>