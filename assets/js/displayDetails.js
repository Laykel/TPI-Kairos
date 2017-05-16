//
$('.project-title').on('click', function(){
	var projectId = $(this).prop('id');
	var projectId = "id=" + projectId;
	$('#panel-details').load('sources/shared/projectDetails.php', projectId);
});

//
$('.task-title').on('click', function(){
	var taskId = $(this).prop('id');
	var taskId = "id=" + taskId;
	$('#panel-details').load('sources/shared/taskDetails.php', taskId);
});