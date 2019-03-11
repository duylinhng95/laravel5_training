require("./vendor/template/jquery.themepunch.plugins.min")
require("./vendor/template/jquery.themepunch.revolution.min")
import * as toastr from 'toastr/toastr';
import Notification from './notification.js'

class Homepage {
	constructor() {
		this.init()
	}

	init() {
		this.config()
		this.listen()
	}

	config() {
		this.element = {
			userId: $("#user_id").val(),
			notification: $("#user_notification"),
			notificationIcon: $("#notification-icon"),
			loginForm: $("#loginForm"),
			registerForm: $("#registerForm"),
			navigationBar: $(".navigation-bar .item-wrapper a"),
			btnReply: $("#btn-redirect"),
			rightSideBar: $(".right-sidebar"),
			commentForm: $("#comment-form"),
			loginStatus: $("#loginStatus"),
			leftSidebar: $(".left-sidebar"),
		}
		this.avatar = {
			previewImage: $("#previewImage"),
			avatarInput: $("#avatarInput"),
			avatarForm: $("#avatarForm"),
		}
		this.postPage = 1
		this.lastPage = false
		this.isActive = 0
		this.apiURL = location.origin + `/api`
		this.currentURL = location.search
		this.notification = new Notification()
		this.userId = this.element.loginStatus.data('user-id')
	}

	listen() {
		this.onScrollDown()
		if (this.element.userId !== undefined) {
			this.showNotifications()
		}
		this.navTab()
		this.setActiveClass(this.element.navigationBar)
		this.validateLoginForm()
		this.validateRegisterForm()
		if (this.element.rightSideBar.length !== 0) {
			this.onScrollToFixSection()
			this.replyBtnClick()
			this.commentFormHover()
		}
		this.getRecommendPost()
		this.onChangeAvatar()
		this.onSubmitFormAvatar()
	}

	loadArticle(page) {
		let self = this
		$("#indexContent").append(`<img class="loading-post" src="../images/loading-post.gif">`)
		$.ajax({
			url: this.apiURL + `/load-post` + this.currentURL,
			type: `GET`,
			data: {page: page},
			success: function (res) {
				$(".loading-post").remove()
				$("#indexContent").append(res.data.view)
				self.isActive = 0
				self.lastPage = res.data.lastPage
			}
		})
	}

	static checkScrollToBottom() {
		let scrollTop = (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop;
		let scrollHeight = $("body").height();
		let clientHeight = document.documentElement.clientHeight || window.innerHeight;
		return Math.ceil(scrollTop + clientHeight) >= scrollHeight;
	}

	checkActiveAPI() {
		this.isActive++
		if (this.isActive === 1) {
			this.postPage++
			let page = this.postPage
			this.loadArticle(page)
		}
	}

	onScrollDown() {
		let self = this
		$(window).on('scroll', function () {
			let scrolledToBottom = Homepage.checkScrollToBottom()
			if (scrolledToBottom && self.lastPage === false) {
				self.checkActiveAPI()
			}
		})
	}

	showNotifications() {
		let self = this
		this.notification.db.collection('notifications')
			.where("user_id", '==', this.element.userId)
			.orderBy('created_at', 'desc')
			.onSnapshot(function (querySnapshot) {
				self.element.notification.children().remove()
				let isAllRead = true
				if (querySnapshot.empty === true) {
					let content = `<div class="row">
								            <div class="col-md-12 text-left notify-element">								            										            		
								                <div class="notify-title">There is no notification currently</div>
								            </div>
								        </div>`
					self.element.notification.append(content)
				}
				querySnapshot.forEach(function (doc) {
					let res = doc.data()
					let is_read = `<i class="fas fa-circle fa-xs"></i>`
					if (res.is_read === true) {
						is_read = ''
					} else {
						isAllRead = false
					}

					let content = '';

					if (res.action !== 'follows') {
						let noti_title = res.title
						if (noti_title.length > 30) {
							noti_title = noti_title.substring(0, 30) + "..."
						}
						content = `<div class="row">
								            <div class="col-md-12 text-left notify-element">								            										            		
								                <a class="notification_read" href="${location.origin + '/' + res.href}">
																	<input type="hidden" value="${doc.id}" name="noti_id">
																	${res.content} ${is_read}																	 
																</a>
																<div class="notify-title">"${noti_title}"</div>
								            </div>
								        </div>`
					} else {
						content = `<div class="row">
								            <div class="col-md-12 text-left notify-element">								            										            		
								                <a class="notification_read" href="#">
																	<input type="hidden" value="${doc.id}" name="noti_id">
																	${res.content} ${is_read} 
																</a>
								            </div>
								        </div>`
					}
					self.element.notification.append(content)
				})
				if (isAllRead === false) {
					self.element.notificationIcon.addClass('active');
				} else {
					self.element.notificationIcon.removeClass('active');
				}
				self.markReadNotification()
			})
	}

	markReadNotification() {
		let self = this
		$('.notification').find('a').each(function (index, value) {
			$(value).hover(function () {
				let notification_id = $(value).find('input').val()

				let notification = self.notification.db.collection('notifications').doc(notification_id)

				notification.update(
					{is_read: true}
				)
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

	setActiveClass(selection) {
		let url = location.href
		selection.each(function (key, value) {
			if (value.href === url) {
				$(value).addClass('active')
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
						let error_message = $("#error-message");
						if (error_message.length !== 0) {
							error_message.remove()
						}
						let loginForm = $('#loginForm')
						loginForm.before(`<div class="alert alert-danger" id="error-message">` + data.message + `</div>`)
						$(".login-section .dropdown-menu").show()
					}
				})
			}
		})
		$('#loginForm button[type="submit"]').click(function () {
			return $('#loginForm').valid();
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
						let error_message = $("#error_message");
						let error_noti = $("#error_noti")
						let errors = data.errors;
						if (error_message.length !== 0) {
							error_message.remove()
							error_noti.remove()
						}
						$.each(errors, function (index, value) {
							let input = $('#registerForm').find(`[name="` + index + `"]`)
							input.before(`<div class="text-danger" id="error_message">` + value + `</div>`)
						})
						let registerForm = $('#registerForm')
						registerForm.before(`<div class="alert alert-danger" id="error_noti">` + data.message + `</div>`)
						$(".login-section .dropdown-menu").show()
					}
				})
			}
		})
		$('#registerForm button[type="submit"]').click(function () {
			return $('#registerForm').valid();
		})
	}

	onScrollToFixSection() {
		let fixTop = this.element.rightSideBar.offset().top
		let width = this.element.rightSideBar.width() + 30
		let marginLeft = $(".detail-post").width() + 30
		$(window).scroll(function () {
			var currentScroll = $(window).scrollTop()
			if (currentScroll >= fixTop) {
				$(".right-sidebar").css({
					'top': '10px',
					'width': width,
					'margin-left': marginLeft,
					'position': 'fixed'
				})
			} else {
				$(".right-sidebar").removeAttr("style")
			}

		});
	}

	replyBtnClick() {
		let btnReply = this.element.btnReply
		let commentForm = this.element.commentForm
		btnReply.click(function () {
			commentForm.addClass('notify-success')
		})
	}

	commentFormHover() {
		let commentForm = this.element.commentForm

		commentForm.mouseover(function () {
			commentForm.removeClass('notify-success')
		})
	}

	getInterestTopic() {
		let userId = this.userId
		let self = this
		return $.ajax({
			url: this.apiURL + '/get-interest',
			type: 'get',
			data: {user_id: userId},
			success: function (response) {
				self.getResponse(response.data)
			}
		})
	}

	getRecommendPost() {
		let loginStatus = this.element.loginStatus.val()
		if (loginStatus === 'true') {
			this.getInterestTopic()
		} else {
			let data = JSON.parse(window.localStorage.getItem('interest'))
			this.requestAjaxInterest(data)
		}
	}

	getResponse(responseData) {
		let data = responseData
		if (data === null) {
			data = JSON.parse(window.localStorage.getItem('interest'))
		}
		this.requestAjaxInterest(data)
	}

	requestAjaxInterest(data = null) {
		$.ajax({
			url: this.apiURL + '/load-interest-post',
			type: 'get',
			data: data,
			success: function (response) {
				let data = response.data
				$(".recommend-section").append(data.view)
			}
		})
	}

	onChangeAvatar() {
		let previewImage = this.avatar.previewImage
		let avatarInput = this.avatar.avatarInput
		let self = this
		avatarInput.change(function (event) {
			if (self.validateAvatarImage()) {
				let input = event.currentTarget
				let reader = new FileReader();
				if (input.files && input.files[0]) {
					reader.onload = function (e) {
						previewImage.attr('src', e.target.result);
					}
					reader.readAsDataURL(input.files[0]);
				}
			}
		})
	}

	onSubmitFormAvatar() {
		let avatarForm = this.avatar.avatarForm
		let avatarInput = this.avatar.avatarInput
		let self = this
		avatarForm.submit(function (event) {
			event.preventDefault();
			if (self.validateAvatarImage()) {
				let formData = new FormData(avatarForm[0])
				formData.append('user_id', avatarInput.data('user-id'))
				$.ajax({
					url: self.apiURL + '/user/avatar',
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,
					success: function (res) {
						location.reload()
					}
				})
			}
		})
	}

	validateAvatarImage() {
		let str = this.avatar.avatarInput.val()
		let mime = str.substring(str.lastIndexOf("."))
		let mimeType = ['.png', '.jpg', '.jpeg']
		if (mimeType.indexOf(mime) !== -1) {
			return true;
		} else {
			toastr.options.preventDuplicates = true
			toastr.error('The file must be type of png, jpg or jpeg', 'Wrong type of file!')
			return false;
		}
	}
}

new Homepage()
