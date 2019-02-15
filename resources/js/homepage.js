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
		this.isActive = 0
		this.apiURL = location.origin + `/api`
		this.currentURL = location.search
	}

	listen() {
		this.onScrollDown()
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
}

new Homepage()
