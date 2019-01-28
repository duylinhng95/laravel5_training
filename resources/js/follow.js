class Follow {
	constructor(){
		this.init()
	}

	init() {
		this.config()
		this.listen()
	}

	config(){
		this.btnFollow = $("#followUser")
		this.btnUnfollow= $("#unfollowUser")
		this.userId = $("#userId")
		this.apiUrl = location.origin
	}

	listen(){
		this.followUser()
		this.unFollowUser()
	}

	followUser()
	{
		let btn = this.btnFollow
		let userId = this.userId.val()
		let url = `${this.apiUrl}`
		btn.on('click', function() {
			$.ajax({
				url: `${url}/user/follow/${userId}`,
				type: "GET",
				success: function(){
					btn.id = "unfollowUser"
					btn.removeClass('btn-primary')
					btn.addClass('btn-danger')
					btn.html('')
					btn.text('Unfollow')
				}
			})
		})
	}

	unFollowUser()
	{
		let btn = this.btnUnfollow
		let userId = this.userId.val()
		let url = `${this.apiUrl}`
		btn.on('click', function() {
			$.ajax({
				url: `${url}/user/unfollow/${userId}`,
				type: "GET",
				success: function(){
					btn.id = "followUser"
					btn.removeClass('btn-danger')
					btn.addClass('btn-primary')
					btn.html('')
					btn.text('Follow')
				}
			})
		})
	}
}

export default Follow
