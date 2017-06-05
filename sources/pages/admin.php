<!-- 
Filename: admin.php
Description: Admin page: Full access to all user data, links to their pages.
-->

<div class="row">
	<div class="col-sm-8 col-sm-offset-2">		  
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Administration des utilisateurs du site</h3>
			</div>
			<div class="panel-body panel-no-padding table-responsive">

				<!-- Table containing all users' data -->
				<table class="table table-striped table-hover table-nomargin">
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
					
						<!-- Display each user's data, links to their projects, to change their data... -->
						<?php while($line = $userRes->fetch()){?>
							<tr>
								<td><?php echo $line['user_id'];?></td>
								<td><?php echo $line['user_pseudo'];?></td>
								<td><?php echo $line['user_mail'];?></td>
								<td><?php echo $line['user_isAdmin'];?></td>
								<td>
									<a href="<?php echo URL;?>?page=profile&id=<?php echo $line['user_id'];?>">
										<button class="btn btn-warning btn-xs">
											<span class="glyphicon glyphicon-cog"></span>
										</button></a>
									<a href="<?php echo URL;?>?page=home&id=<?php echo $line['user_id'];?>">
										<button class="btn btn-warning btn-xs">
											<span class="glyphicon glyphicon-th-list"></span>
										</button></a>
									<a href="<?php echo URL;?>?page=journal&id=<?php echo $line['user_id'];?>">
										<button class="btn btn-warning btn-xs">
											<span class="glyphicon glyphicon-align-justify"></span>
										</button></a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
