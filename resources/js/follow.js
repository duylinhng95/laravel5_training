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
	}

	listen() {
		this.followUser()
		this.unfollowUser()
	}

	followUser() {
		let url = `${this.apiUrl}`
		let btnFollow = this.element.btnFollow

		btnFollow.on('click', function () {
			let userId = $(this).attr('data-user-id')

			$.ajax({
				url: `${url}/user/follow/${userId}`,
				type: "GET",
				success: function () {
					$(`.btn-follow[data-user-id=${userId}]`).addClass('d-none')
					$(`.btn-unfollow[data-user-id=${userId}]`).removeClass('d-none')
				}
			})
		})
	}

	unfollowUser() {
		let url = `${this.apiUrl}`
		let btnUnfollow = this.element.btnUnfollow
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
