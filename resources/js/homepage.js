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
		this.currentURL = location.search
	}

	listen() {
		this.onScrollDown()
	}

	loadArticle(page) {
		let self = this
		$.ajax({
			url: this.apiURL + `/load-post`+this.currentURL,
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

			let scrollTop = (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop;
			let scrollHeight = (document.documentElement && document.documentElement.scrollHeight) || document.body.scrollHeight;
			let clientHeight = document.documentElement.clientHeight || window.innerHeight;
			let scrolledToBottom = Math.ceil(scrollTop + clientHeight) >= scrollHeight;
			if (scrolledToBottom && self.lastPage === false) {
				self.postPage++
				let page = self.postPage
				self.loadArticle(page)
			}
		})
	}
}

new Homepage()
