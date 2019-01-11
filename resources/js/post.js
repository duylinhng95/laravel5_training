require('./bootstrap.js')

// window.Summernote = require('../../node_modules/summernote/dist/summernote-bs4');
window.Summernote = require('summernote/dist/summernote-bs4');
window.Tagsinput = require('../../node_modules/bootstrap4-tagsinput-douglasanpa/tagsinput.js');

$(document).ready(function () {
	$('#texteditor').summernote();
});

window.deletePost = function deletePost(id) {
	$.ajax({
		url: deletePostURI + id,
		type: "DELETE",
		data: {_token: csrf_token},
		success: function (res) {
			if (res.code == 200) {
				location.reload();
			}
		}
	})
}
