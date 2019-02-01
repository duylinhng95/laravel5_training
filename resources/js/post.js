require('./bootstrap.js')
window.Summernote = require('summernote/dist/summernote-bs4');
window.Tagsinput = require('../../node_modules/bootstrap4-tagsinput-douglasanpa/tagsinput.js');
import Comment from './comment.js'
import Follow from './follow.js'

class Post {
	constructor() {
		this.init()
		new Comment()
		new Follow()
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
		this.navTab()
		this.setActiveClass()
	}

	btnSearchEnter(name) {
		let btnSearch = name
		this.element.keywords.keypress(function (event) {
			if (event.which === 13) {
				btnSearch.click()
			}
		})
	}

	onSearch(name) {
		let input = this.element.keywords
		name.on('click', function () {
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
				success: function () {
					location.reload();
				}
			})
		})
	}

	votePost() {
		let voteNum = this.element.voteNum
		let url = `${this.apiUrl}/post/vote`
		let indexNum = 0;
		this.element.btnVotePost.on('click', function (event) {
			let id = event.target.children.postId.value
			$.ajax({
				url: `${url}/${id}`,
				type: "GET",
				success: function () {
					indexNum = voteNum.html();
					indexNum++;
					voteNum.text(indexNum);
				}
			})
		})
	}

	navTab() {

		$('#sign-in').click(function (event) {
			$("#signup").removeClass('active show')
			$("#sign-in").parent('li').addClass('active')
			$("#sign-up").parent('li').removeClass('active')
			event.stopPropagation()
			$("#signin").tab('show')
		})

		$('#sign-up').click(function (event) {
			$("#signin").removeClass('active show')
			$("#sign-up").parent('li').addClass('active')
			$("#sign-in").parent('li').removeClass('active')
			event.stopPropagation()
			$("#signup").tab('show')
		})
	}

	setActiveClass() {
		let url = location.href
		$(".collapsed").each(function () {
			if (this.href === url) {
				$(this).removeClass('collapsed')
			}
		})
	}
}

new Post()
