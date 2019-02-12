require('./bootstrap.js')
window.Summernote = require('summernote/dist/summernote');
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
		$('#texteditor').summernote({height: 300})
		$('#tagsinput').tagsinput({
			confirmKeys: [188, 32]
		});
	}

	config() {
		this.element = {
			btnSearchPost: $("#btnSearchPost"),
			btnSearchUser: $("#btnSearchUser"),
			keywords: $("#keywords"),
			btnDeletePost: $("#btnDeletePost"),
			btnVotePost: $("#btnVotePost"),
			voteNum: $("#voteNum"),
			loginForm: $("#loginForm"),
			registerForm: $("#registerForm"),
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
		this.validateLoginForm()
		this.validateRegisterForm()
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
		let keywords = this.element.keywords
		name.on('click', function () {
			let url = location.pathname
			let input = keywords.val()
			if (input === '') {
				alert("Search can't be empty")
			} else {
				window.location.href = `${url}?keywords=${input}`
			}
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

	validateLoginForm() {
		let form = this.element.loginForm
		form.validate({
			rules: {
				email: {
					required: true,
					email: true,
				},
				password: {
					required: true,
				}
			},
			messages: {
				email: {
					required: "Please enter your email",
					email: "Please enter correct email format",
				},
				password: {
					required: "Please enter your password"
				}
			},
			submitHandler: function (form) {
				$.ajax({
					url: location.origin + `/validateLogin`,
					type: "POST",
					data: $(form).serialize(),
					success: function (res) {
						form.submit(res)
					},
					error: function (res) {
						let data = res.responseJSON
						let input = $('#loginForm')
						input.before(`<div class="alert alert-danger">` + data.message + `</div>`)
					}
				})
			}
		})
	}

	validateRegisterForm() {
		let form = this.element.registerForm
		form.validate({
			rules: {
				name: "required",
				email: {
					required: true,
					email: true,
				},
				password: "required",
				password_confirmation: {
					required: true,
					equalTo: "#password",
				},
			},
			messages: {
				name: {
					required: "Please enter your fullname"
				},
				email: {
					required: "Please enter your email",
					email: "Please enter correct email format",
				},
				password: {
					required: "Please enter your password"
				},
				password_confirmation: {
					required: "Please confirm your password",
					equalTo: "Your password confirm must match"
				}
			},
			submitHandler: function (form) {
				$.ajax({
					url: location.origin + `/validateRegister`,
					type: "POST",
					data: $(form).serialize(),
					success: function (res) {
						form.submit(res)
					},
					error: function (res) {
						let data = res.responseJSON
						let errors = data.errors
						$.each(errors, function (index, value) {
							let input = $('#registerForm').find(`[name="` + index + `"]`)
							input.before(`<div class="text-danger">` + value + `</div>`)
						})
					}
				})
			}
		})
	}
}

new Post()
