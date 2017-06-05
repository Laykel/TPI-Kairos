$( document ).ready(function(){
	//When the close button is clicked
	$('#close').on('click', function(e){
		var projectId = $(this).closest("div").prop('id');

		//Send ID to PHP to close project in DB
		var request = $.ajax({
			url: 'sources/shared/update.php',
			type: 'post',
			data: {"close": projectId}
		});
		//When done, reload page
		request.done(function(){
			window.location.reload();
		});
	});

	//When the reopen button is clicked
	$('#reopen').on('click', function(e){
		var projectId = $(this).closest("div").prop('id');

		//Send ID to PHP to open project in DB
		var request = $.ajax({
			url: 'sources/shared/update.php',
			type: 'post',
			data: {"reopen": projectId}
		})
		//When done, reload page
		request.done(function(){
			window.location.reload();
		});
	});

	//When the delete project button is clicked
	$('#removeProject').on('click', function(e){
		var projectId = $(this).closest("div").prop('id');
		//Hide the text meant for account deletion
		$("#account").hide();

		//Invoke the modal to ask for confirmation
		$('#confirm').modal({
			backdrop: 'static',
			keyboard: false
		})
		//If he says yes, send ID to PHP to delete project
		.one('click', '#yes', function(e){
			var request = $.ajax({
				url: 'sources/shared/update.php',
				type: 'post',
				data: {"removeProject": projectId}
			});
			//When done, reload page
			request.done(function(){
				window.location.reload();
			});
		});
	});

	//When the delete task button is clicked
	$('#removeTask').on('click', function(e){
		var projectId = $(this).closest("div").prop('id');
		//Hide the text meant for account deletion
		$("#account").hide();

		//Invoke the modal to ask for confirmation
		$('#confirm').modal({
			backdrop: 'static',
			keyboard: false
		})
		//If he says yes, send ID to PHP to delete task
		.one('click', '#yes', function(e){
			var request = $.ajax({
				url: 'sources/shared/update.php',
				type: 'post',
				data: {"removeTask": projectId}
			});
			//When done, reload page
			request.done(function(){
				window.location.reload();
			});
		});
	});

	//When the delete account button is clicked
	$('#removeAccount').on('click', function(e){
		var accountId = $(this).closest("div").prop('id');
		//Hide the modal text for the deletion of projects or tasks
		$("#projectOrTask").hide();

		//Invoke the modal to ask for confirmation
		$('#confirm').modal({
			backdrop: 'static',
			keyboard: false
		})
		//If he says yes, send ID to PHP to delete user account
		.one('click', '#yes', function(e){
			var request = $.ajax({
				url: 'sources/shared/update.php',
				type: 'post',
				data: {"removeAccount": accountId}
			});
			//When done, logout user
			request.done(function(){
				window.location = "?page=logout";
			});
		});
	});

	//When an opened task's checkbox is ticked
	$('.taskCB').change(function(){
		var taskId = $(this).closest('td').next('td').prop('id');
		
		//Send ID to PHP to close the task
		var request = $.ajax({
			url: 'sources/shared/update.php',
			type: 'post',
			data: {"closeTask": taskId}
		});
		//When done, reload page
		request.done(function(){
			window.location.reload();
		});
	});

	//When a closed task's checkbox is ticked
	$('.taskCBClosed').change(function(){
		var taskId = $(this).closest('td').next('td').prop('id');
		
		//Send ID to PHP to open the task
		var request = $.ajax({
			url: 'sources/shared/update.php',
			type: 'post',
			data: {"reopenTask": taskId}
		});
		//When done, reload page
		request.done(function(){
			window.location.reload();
		});
	});
});