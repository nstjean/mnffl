$(".delete-form").on("submit", function(){
    return confirm("Permanently delete?");
});

$(".delete-anchor").on("click", function(){
	event.preventDefault();
	if(confirm("Permanently delete this post?")) {
		let postID = $(this).attr('data-value');
		$("#"+postID).submit();
	}
});