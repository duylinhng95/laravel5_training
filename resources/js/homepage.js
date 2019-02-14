class Homepage {
	constructor() {
		this.init()
	}

	init() {
		this.listen()
		this.config()
	}

	config() {
		this.postPage = 1
		this.lastPage = false
		this.apiURL = location.origin + `/api`
	}

	listen() {
		this.onScrollDown()
	}

	loadArticle(page) {
		let self = this
		$.ajax({
			url: this.apiURL + `/load-post`,
			type: `GET`,
			data: {page: page},
			success: function (res) {
				$("#indexContent").append(res.data)
			},
			error: function (response) {
				let res = response.responseJSON
				self.postPage = res.data
				self.lastPage = true
			}
		})
	}

	onScrollDown() {
		let self = this
		$(window).on('scroll', function () {
			let scrollPosition = $(window).height() + $(window).scrollTop()
			let scrollHeight = $(document).height()
			if ((scrollPosition / scrollHeight) * 100 > 93 && self.lastPage === false) {
				self.postPage++
				let page = self.postPage
				self.loadArticle(page)
			}
		})
	}
}

new Homepage()
