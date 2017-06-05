$( document ).ready(function() {
	
	//Clicking on the project's title opens the details panel
	//and scrolls to it.
	$('.project-title').on('click', function(){
		var projectId = $(this).prop('id');
		projectId = "id=" + projectId;

		//Load the panel from the taskDetails file
		$('#panel-details').load('sources/shared/projectDetails.php', projectId);

		//Scroll to the panel
		$('html, body').animate({
			scrollTop: $('#details-top').position().top-60
		}, 500);
	    return false;
	});

	//Clicking on the task's title opens the details panel
	//and scrolls to it.
	$('.task-title').on('click', function(){
		var taskId = $(this).prop('id');
		taskId = "id=" + taskId;

		//Load the panel from the taskDetails file
		$('#panel-details').load('sources/shared/taskDetails.php', taskId);

		//Scroll to the panel
		$('html, body').animate({
			scrollTop: $('#details-top').position().top-60
		}, 500);
		return false;
	});

	//On page load, trigger a click on the first project
	$('.panel-title:first').trigger('click');
});
