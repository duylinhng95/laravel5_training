require('./bootstrap.js')
window.Summernote = require('summernote/dist/summernote-bs4');
window.Tagsinput = require('../../node_modules/bootstrap4-tagsinput-douglasanpa/tagsinput.js');

class Post {
	constructor() {
		this.init()
	}

	init() {
		this.config()
		this.listen()
		this.element.textEditor.summernote()
	}

	config() {
		this.element = {
			textEditor: $('#texteditor'),
			btnSearchPost: $("#btnSearchPost"),
			btnSearchUser: $("#btnSearchUser"),
			keywords: $("#keywords"),
			btnDeletePost: $("#btnDeletePost"),
			btnVotePost: $("#btnVotePost"),
			voteNum: $("#voteNum"),
		}
		this.apiUrl = location.origin
	}

	listen() {
		this.btnSearchEnter(this.element.btnSearchPost)
		this.btnSearchEnter(this.element.btnSearchUser)
		this.onSearch(this.element.btnSearchPost)
		this.onSearch(this.element.btnSearchUser)
		this.deletePost()
		this.votePost()
	}

	btnSearchEnter(name) {
		let btnSearch = name
		this.element.keywords.keypress(function (event) {
			if(event.which === 13) {
				btnSearch.click()
			}
		})
	}

	onSearch(name) {
		let input = this.element.keywords
		name.on('click', function (event) {
			let url = location.pathname
			input = input.val()
			window.location.href = `${url}?keywords=${input}`
		})
	}

	deletePost() {
		let url = `${this.apiUrl}/user/post`
		this.element.btnDeletePost.on('click', function (event) {
			let id = event.target.children.postId.value
			let token = event.target.children[1].value
			$.ajax({
				url: `${url}/${id}`,
				type: "DELETE",
				data: {_token: token},
				success: function (res) {
					location.reload();
				}
			})
		})
	}

	votePost() {
		let voteNum = this.element.voteNum
		let url = `${this.apiUrl}/post/vote`
		let indexNum = 0;
		this.element.btnVotePost.on('click', function(event) {
			let id = event.target.children.postId.value
			$.ajax({
				url: `${url}/${id}`,
				type: "GET",
				success: function (res) {
					indexNum = voteNum.html();
					indexNum++;
					voteNum.text(indexNum);
				}
			})
		})
	}

}

new Post()

export default Post
