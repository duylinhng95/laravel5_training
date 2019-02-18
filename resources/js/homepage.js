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
		this.postPage = 1
		this.lastPage = false
		this.isActive = 0
		this.apiURL = location.origin + `/api`
		this.currentURL = location.search
		this.notification = new Notification()
		this.userId = $("#user_id").val()
		this.element = {
			userId: $("#user_id").val(),
			notification: $("#user_notification"),
			notificationIcon: $("#notification-icon"),
		}
	}

	listen() {
		this.onScrollDown()
		if (this.element.userId !== undefined) {
			this.showNotifications()
		}
	}

	loadArticle(page) {
		let self = this
		$.ajax({
			url: this.apiURL + `/load-post` + this.currentURL,
			type: `GET`,
			data: {page: page},
			success: function (res) {
				$("#indexContent").append(res.data.view)
				self.isActive = 0
				self.lastPage = res.data.lastPage
			}
		})
	}

	checkScrollToBottom() {
		let scrollTop = (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop;
		let scrollHeight = $(".wrapper").height();
		let clientHeight = document.documentElement.clientHeight || window.innerHeight;
		let scrolledToBottom = Math.ceil(scrollTop + clientHeight) >= scrollHeight;

		return scrolledToBottom;
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
			let scrolledToBottom = self.checkScrollToBottom()
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
				querySnapshot.forEach(function (doc) {
					let res = doc.data()
					let is_read = `<i class="fas fa-circle fa-xs"></i>`
					if (res.is_read === true) {
						is_read = ''
					} else {
						isAllRead = false
					}

					let content = '';

					if (res.href !== '#' || res.href)
					{
						content = `<div class="row">
								            <div class="col-md-12 text-left">								            										            		
								                <a class="notification_read" href="${location.origin + '/' + res.href}">
																	<input type="hidden" value="${doc.id}" name="noti_id">
																	${res.content} ${is_read} 
																</a>
								            </div>
								        </div>`
					} else {
						content = `<div class="row">
								            <div class="col-md-12 text-left">								            										            		
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
					self.element.notificationIcon.addClass('badge');
				} else {
					self.element.notificationIcon.removeClass('badge');
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
}

new Homepage()
