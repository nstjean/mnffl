$(".delete-form").on("submit", function(){
    return confirm("Permanently delete?");
});

// Post delete button
$(".delete-anchor").on("click", function(){
	event.preventDefault();
	if(confirm("Permanently delete this post?")) {
		let postID = $(this).attr('data-value');
		$("#"+postID).submit();
	}
});

// Hover clickable-row
$(".clickable-row").hover(
	function() { $(this).addClass('active') },
	function() { $(this).removeClass('active')}
);