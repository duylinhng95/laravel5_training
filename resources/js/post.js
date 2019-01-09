require('./bootstrap.js')

// window.Summernote = require('../../node_modules/summernote/dist/summernote-bs4');
window.Summernote = require('summernote/dist/summernote-bs4');
window.Tagsinput = require('../../node_modules/bootstrap4-tagsinput-douglasanpa/tagsinput.js');

$(document).ready(function () {
	$('#texteditor').summernote();
});
