require('./bootstrap.js')
window.Summernote = require('summernote/dist/summernote');
window.Tagsinput = require('../../node_modules/bootstrap4-tagsinput-douglasanpa/tagsinput.js');
require('./vendor/summernote/summernote-ext-highlight')
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
		$('#texteditor').summernote({
			height: 300,
			prettifyHtml: false,
			toolbar: [
				['style', ['style']],
				['font', ['bold', 'italic', 'underline', 'highlight']],
				['font', ['fontsize', 'color', 'superscript', 'subscript']],
				['para', ['paragraph']],
				['insert', ['link', 'picture', 'video']],
				['misc', ['undo', 'fullscreen']]
			],
		})
		$('#tagsinput').tagsinput({
			confirmKeys: [188, 13]
		});
	}

	config() {
		this.element = {
			btnSearch: $("#btnSearch"),
			btnSearchUser: $("#btnSearchUser"),
			keywords: $("#keywords"),
			keywordsUser: $("#keywordsUser"),
			btnDeletePost: $(".btn-delete-post"),
			btnVotePost: $("#btnVotePost"),
			voteNum: $("#voteNum"),
			loginForm: $("#loginForm"),
			registerForm: $("#registerForm"),
			createForm: $("#createForm"),
		}
		this.apiUrl = location.origin
	}

	listen() {
		this.btnSearchEnter(this.element.btnSearchUser, this.element.keywordsUser)
		this.onSearch(this.element.btnSearchUser, this.element.keywordsUser)
		this.deletePost()
		this.votePost()
		this.navTab()
		this.setActiveClass()
		this.validateLoginForm()
		this.validateRegisterForm()
		this.enterSearchHomepage()
		this.validateCreatePost()
	}

	btnSearchEnter(name, section) {
		let btnSearch = name
		section.keypress(function (event) {
			if (event.which === 13) {
				btnSearch.click()
			}
		})
	}

	onSearch(name, section) {
		let keywords = section
		let url = ''
		name.on('click', function () {
			url = location.pathname
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
			let id = $(event.currentTarget).data('postId')
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
					url: location.origin + `/api/check-login`,
					type: "POST",
					data: $(form).serialize(),
					success: function (res) {
						form.submit(res)
					},
					error: function (res) {
						let data = res.responseJSON
						let input = $('#loginForm')
						let error_message = $("#error-message");
						if (error_message.length != 0) {
							error_message.remove()
						}
						input.before(`<div class="alert alert-danger" id="error-message">` + data.message + `</div>`)
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
					url: location.origin + `/api/check-register`,
					type: "POST",
					data: $(form).serialize(),
					success: function () {
						form.submit()
					},
					error: function (res) {
						let data = res.responseJSON
						let errors = data.errors
						let error_message = $("#error-message");
						if (error_message.length != 0) {
							error_message.remove()
						}
						$.each(errors, function (index, value) {
							let input = $('#registerForm').find(`[name="` + index + `"]`)
							input.before(`<div class="text-danger" id="error_message">` + value + `</div>`)
						})
					}
				})
			}
		})
	}

	searchHomepage() {
		let self = this
		let button = this.element.btnSearch
		button.on('click', function () {
			let keywords = self.element.keywords.val()
			location.href = self.apiUrl + '/browse?keywords=' + keywords
		})

	}

	enterSearchHomepage() {
		let keyword = this.element.keywords
		let button = this.element.btnSearch
		keyword.keypress(function (event) {
			if (event.which === 13) {
				button.click()
			}
		})
	}

	validateCreatePost() {
		let form = this.element.createForm
		form.validate({
			rules: {
				title: {
					required: true,
				},
				tags: {
					required: true,
				},
				content: {
					required: true,
				}
			},
			messages: {
				title: {
					required: "Please enter Post's title"
				},
				tags: {
					required: "Please enter Post's tags"
				},
				content: {
					required: "Please enter Post's content"
				}
			},
			submitHandler: function(form) {
				form.submit()
			}
		})
	}
}

new Post()
