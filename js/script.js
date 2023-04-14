$(document).ready(function(){
	loadComments();
	
	$("#comment-form").on("submit", function(e){
		e.preventDefault();
		
		var formData = $(this).serialize();
		
		$.ajax({
			url: "submit_comment.php",
			type: "post",
			data: formData,
			success: function(response){
				$("#comment-form")[0].reset();
				loadComments();
			}
		});
	});
});

function loadComments(){
	$.ajax({
		url: "get_comments.php",
		type: "get",
		success: function(response){
			$("#comment-list").html(response);
		}
	});
}