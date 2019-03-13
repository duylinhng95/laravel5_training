import Notification from './notification.js'

class Follow {
	constructor() {
		this.init()
	}

	init() {
		this.config()
		this.listen()
	}

	config() {
		this.element = {
			btnFollow: $(".btn-follow"),
			btnUnfollow: $(".btn-unfollow")
		}
		this.sectionFollow = $(".section-follow")
		this.apiUrl = location.origin
		this.notification = new Notification()
	}

	listen() {
		this.followUser()
		this.unfollowUser()
	}

	followUser() {
		let url = `${this.apiUrl}`
		let btnFollow = this.element.btnFollow
		let self = this

		btnFollow.on('click', function () {
			let userId = $(this).attr('data-user-id')

			$.ajax({
				url: `${url}/user/follow/${userId}`,
				type: "GET",
				success: function (res) {
					let data = {
						action: 'follows',
						content: `You have been followed by an User`,
						is_read: false,
						user_id: res.data.follower_id,
						created_at: new Date($.now()).getTime(),
						href: '#',
					}
					self.notification.db.collection('notifications').add(data)

					$(`.btn-follow[data-user-id=${userId}]`).addClass('d-none')
					$(`.btn-unfollow[data-user-id=${userId}]`).removeClass('d-none')
				}
			})
		})
	}

	unfollowUser() {
		let url = `${this.apiUrl}`
		let btnUnfollow = this.element.btnUnfollow
		let self = this

		btnUnfollow.on('click', function () {
			let userId = $(this).attr('data-user-id')
			$.ajax({
				url: `${url}/user/follow/${userId}`,
				type: "GET",
				success: function () {
					$(`.btn-unfollow[data-user-id=${userId}]`).addClass('d-none')
					$(`.btn-follow[data-user-id=${userId}]`).removeClass('d-none')
				}
			})
		})
	}
}

export default Follow
