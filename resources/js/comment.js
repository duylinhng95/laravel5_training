window.addComment = function addComment(id) {
	var formData = $("#comment").serialize();

	$.ajax({
		url: addCommentURI + id,
		type: "POST",
		data: formData,
		success: function (response) {
			var res = response.data;
			$(".comment-list").append('<div class="article-content">' +
				'<div class="article-comment-top">' +
				'<div class="comments-user">' +
				'<div class="user-name">'
				+ res.user.name +
				'</div><div class="comment-post-date">Posted On ' +
				'<span class="italics">'
				+ res.created_at +
				'</span></div></div><div class="comments-content">'
				+res.content+
				'</div></div></div>');
			$("#commentContent").val("");
			value = $("#commentNum").html();
			value++;
			$('#commentNum').text(value);
		}
	})
}
