// Confirm delete for delete - possibly no longer needed
$(".delete-form").on("submit", function(){
    return confirm("Permanently delete?");
});

// Post delete button for posts
$(".delete-anchor").on("click", function(){
	event.preventDefault();
	if(confirm("Permanently delete?")) {
		let postID = $(this).attr('data-value');
		$("#"+postID).submit();
	}
});
