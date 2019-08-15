// Confirm delete for delete - possibly no longer needed
$(".delete-form").on("submit", function(){
    return confirm("Permanently delete?");
});

// Post delete button for posts
// submits the hidden form
$(".delete-anchor").on("click", function(){
	event.preventDefault();
	if(confirm("Permanently delete?")) {
		let postID = $(this).attr('data-value');
		$("#"+postID).submit();
	}
});

// Delete button for images on edit post page
$(".delete-icon").on("click", function() {
	event.preventDefault();
	$("#delete-image-checkbox").val(true);
	$("#image-exists").val(false);
	$(this).parent().hide('slow', () =>	$(".restore-icon").toggleClass('show'));
});
// Restore button for images on edit post page
$(".restore-icon").on("click", function() {
	event.preventDefault();
	$("#delete-image-checkbox").val(false);
	$("#image-exists").val(true);
	$(".restore-icon").toggleClass('show');
	$(".edit-photo").delay(300).show('slow');
});