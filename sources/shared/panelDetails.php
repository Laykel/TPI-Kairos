<?php 

?>

<div class="panel-heading">
  <h3 class="panel-title">Détails du projet</h3>
</div>
<div class="panel-body">
	<form method="post" action="">
		<div class="form-group">
			<label for="titre">Titre du projet</label>
			<input type="text" class="form-control" id="titre" name="fTitre" maxlength="45">
		</div>
		<div class="form-group">
			<label for="desc">Description</label>
			<textarea class="form-control" id="desc" rows="3" name="fDescription" maxlength="500"></textarea>
		</div>
		<div class="form-group">
			<label for="dateCreation">Date de création</label>
			<input type="date" class="form-control" id="dateCreation" name="fDateCreation" disabled="">
		</div>
		<div class="form-group">
			<label for="dateStart">Date de début prévue</label>
			<input type="date" class="form-control" id="dateStart" name="fDateStart">
		</div>
		<div class="form-group">
			<label for="dateEnd">Date de fin prévue</label>
			<input type="date" class="form-control" id="dateEnd" name="fDateEnd">
		</div>
		<button type="submit" class="btn btn-info pull-right">Soumettre</button>
	</form>
</div>
<div class="panel-footer">
	<button type="submit" class="btn btn-default">Fermer</button>
  <button type="submit" class="btn btn-danger pull-right">
  	<span class="glyphicon glyphicon-trash"></span>
  </button>
</div>