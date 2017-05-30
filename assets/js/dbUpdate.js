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

	/*$('.newTask').on('submit', function(e){
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
	});*/

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

	$('.timerPlay').on('click', function(e){
		//Get the task's id
		var id = $(this).prop('id');

		$('#comment-modal').modal({
			backdrop: 'static',
			keyboard: false
		})
		.one('click', '#yes', function(e){
			//add comment
			console.log('yo');
		});

		/*//Hide the time from the DB and show the timer
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
		$("#sw_start").trigger("click");*/
	});

	$('.timerPause').on('click', function(e){
		//Re-activate all play buttons
		$('.timerPlay').prop("disabled", false);

		//Hide the pause button and show the play button
		$(this).closest('td').hide();
		$(this).closest('td').prev('td').show();

		//Get the task's id
		var id = $(this).prop('id');
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