window.addComment = function addComment(id) {
	var formData = $("#comment").serialize();

	$.ajax({
		url: addCommentURI + id,
		type: "POST",
		data: formData,
		success: function (res) {
			$(".comment-list").append('<div class=\"media\"><div class=\"media-body\"><h4 class=\"media-heading user_name\">' + res.user.name + '</h4>' + res.content + '</div></div>');
		}
	})
}
