<div class="row">
	<div class="col-sm-8 col-sm-offset-2">		  
		<div class="panel panel-primary">
	    <div class="panel-heading">
	      <h3 class="panel-title">Administration des utilisateurs du site</h3>
	    </div>
	    <div class="panel-body">
	    	<table class="table table-striped table-hover ">
					<thead>
  					<tr>
    					<th>User ID</th>
				      <th>Pseudonyme</th>
				      <th>Adresse mail</th>
				      <th>Admin?</th>
				      <th>Modifier</th>
			    	</tr>
				  </thead>
				  <tbody>
		      <?php while($line = $userRes->fetch()){?>
			      <tr>
			      	<td><?php echo $line['user_id'];?></td>
			      	<td><?php echo $line['user_pseudo'];?></td>
			      	<td><?php echo $line['user_mail'];?></td>
			      	<td><?php echo $line['user_isAdmin'];?></td>
			      	<td><button class="btn btn-warning btn-xs">Modifier</button></td>
			      </tr>
		      <?php } ?>
		      </tbody>
	      </table>
	    </div>
	  </div>
	</div>
</div>