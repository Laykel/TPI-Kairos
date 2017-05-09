<div class="container">
  <div class="col-sm-7">
    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Nouveau projet</button> <br><br>
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Projet numéro 1</h3>
      </div>
      <div class="panel-body">
        
      </div>
      <div class="panel-footer">
        
      </div>
    </div>
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Liste de course</h3>
      </div>
      <div class="panel-body">
        <div class="col-sm-8">
          <input class="form-control" id="inputTitre" placeholder="Nouvelle tâche" type="text">
          </div><div class="col-sm-1">
          <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span></button>
        </div>
      </div>
      <div class="panel-footer">
        
      </div>
    </div>
  </div>
  <div class="col-sm-5">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Détails du projet</h3>
      </div>
      <div class="panel-body">
        <form class="form-horizontal">
          <fieldset>
            <div class="form-group">
              <label for="inputTitre" class="col-lg-12 control-label">Titre du projet</label>
              <div class="col-lg-12">
                <input class="form-control" id="inputTitre" placeholder="Projet numéro 1" type="text">
              </div>
            </div>
            <div class="form-group">
              <label for="inputDesc" class="col-lg-12 control-label">Description</label>
              <div class="col-lg-12">
                <textarea class="form-control" rows="3" id="inputDesc"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputTitre" class="col-lg-12 control-label">Date de création</label>
              <div class="col-lg-12">
                <input class="form-control" id="inputTitre" placeholder="" type="text" disabled="">
              </div>
            </div>
            <div class="form-group">
              <label for="inputTitre" class="col-lg-12 control-label">Date de début prévue</label>
              <div class="col-lg-12">
                <input class="form-control" id="inputTitre" placeholder="" type="date">
              </div>
            </div>
            <div class="form-group">
              <label for="inputTitre" class="col-lg-12 control-label">Date de fin prévue</label>
              <div class="col-lg-12">
                <input class="form-control" id="inputTitre" placeholder="" type="text">
              </div>
            </div>
            <div class="form-group">
              <div class="col-lg-10 col-lg-offset-2">
                <button type="submit" class="btn btn-info">Soumettre</button>
              </div>
            </div>
          </fieldset>
        </form>
        <hr>
        <form>
          <button type="submit" class="btn btn-default">Fermer</button>
          <button type="submit" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-trash"></span></button>
        </form>
      </div>
    </div>
  </div>
</div>