require('./bootstrap.js')

// window.Summernote = require('../../node_modules/summernote/dist/summernote-bs4');
window.Summernote = require('summernote/dist/summernote-bs4');
window.Tagsinput = require('../../node_modules/bootstrap4-tagsinput-douglasanpa/tagsinput.js');

$(document).ready(function () {
	$('#texteditor').summernote();
});

if($("#btnSearch").length != 0){
	$(document).on('keypress', function (e) {
		if (e.which == 13) {
			$('#btnSearch').click();
		}
	});
}

window.deletePost = function deletePost(id) {
	$.ajax({
		url: deletePostURI + id,
		type: "DELETE",
		data: {_token: csrf_token},
		success: function (res) {
				location.reload();
		}
	})
}

window.votePost = function votePost(id) {
	$.ajax({
		url: votePostURI + id,
		type: "GET",
		success: function (res) {
			value = $("#voteNum").html();
			value++;
			$('#voteNum').text(value);
		}
	})
}

window.searchHome = function searchHome() {
	var input = $('#keywords').val();
	window.location.href="/post?keyword="+input;
}

window.searchUser = function searchUser() {
	var input = $('#keywords').val();
	window.location.href="/user?keyword="+input;
}
