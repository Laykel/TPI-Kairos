$( document ).ready(function(){
	
	$('#close').on('click', function(e){
		var projectId = $(this).closest("div").prop('id');

		var request = $.ajax({
			url: 'sources/shared/update.php',
			type: 'post',
			data: {"close": projectId}
		});

		request.done(function(){
			window.location.reload();
		});
	});

	$('#reopen').on('click', function(e){
		var projectId = $(this).closest("div").prop('id');

		var request = $.ajax({
			url: 'sources/shared/update.php',
			type: 'post',
			data: {"reopen": projectId}
		})

		request.done(function(){
			window.location.reload();
		});
	});

	$('#removeProject').on('click', function(e){
		var projectId = $(this).closest("div").prop('id');
		$("#account").hide();

		$('#confirm').modal({
			backdrop: 'static',
			keyboard: false
		})
		.one('click', '#yes', function(e){
			var request = $.ajax({
				url: 'sources/shared/update.php',
				type: 'post',
				data: {"removeProject": projectId}
			});

			request.done(function(){
				window.location.reload();
			});
		});
	});

	$('#removeTask').on('click', function(e){
		var projectId = $(this).closest("div").prop('id');
		$("#account").hide();

		$('#confirm').modal({
			backdrop: 'static',
			keyboard: false
		})
		.one('click', '#yes', function(e){
			var request = $.ajax({
				url: 'sources/shared/update.php',
				type: 'post',
				data: {"removeTask": projectId}
			});

			request.done(function(){
				window.location.reload();
			});
		});
	});

	$('#removeAccount').on('click', function(e){
		var accountId = $(this).closest("div").prop('id');
		//Hide the modal text for the deletion of projects or tasks
		$("#projectOrTask").hide();

		$('#confirm').modal({
			backdrop: 'static',
			keyboard: false
		})
		.one('click', '#yes', function(e){
			var request = $.ajax({
				url: 'sources/shared/update.php',
				type: 'post',
				data: {"removeAccount": accountId}
			});

			request.done(function(){
				window.location = "?page=logout";
			});
		});
	});

	$('.taskCB').change(function(){
		var taskId = $(this).closest('td').next('td').prop('id');
		
		var request = $.ajax({
			url: 'sources/shared/update.php',
			type: 'post',
			data: {"closeTask": taskId}
		});

		request.done(function(){
			window.location.reload();
		});
	});

	$('.taskCBClosed').change(function(){
		var taskId = $(this).closest('td').next('td').prop('id');
		
		var request = $.ajax({
			url: 'sources/shared/update.php',
			type: 'post',
			data: {"reopenTask": taskId}
		});

		request.done(function(){
			window.location.reload();
		});
	});
});