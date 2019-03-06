class Browse {
	constructor() {
		this.init()
	}

	init() {
		this.config()
		this.listen()
	}

	config() {
		this.element = {
			browseWidget: $("#browseWidget"),
			btnSearchPost: $("#btnSearchPost"),
			keywordsPost: $("#keywordsPost"),
			mainContent: $("#mainContent"),
		}
		this.apiURL = location.origin + '/api/browse'
	}

	listen() {
		this.btnSearchEnter(this.element.btnSearchPost, this.element.keywordsPost)
		this.onSearch(this.element.btnSearchPost, this.element.keywordsPost)
		this.checkInput()
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
		let self = this
		name.on('click', function () {
			let input = keywords.val()
			if (input === '') {
				alert("Search can't be empty")
			} else {
				self.callAjaxApi({keywords: input})
			}
		})
	}

	checkInput() {
		let params = new URLSearchParams(location.search)
		if (params.get('keywords')) {
			let keywords = params.get('keywords')
			this.element.keywordsPost.val(keywords)
			this.callAjaxApi({keywords: keywords})
		}
	}

	callAjaxApi(input) {
		let mainContent = this.element.mainContent
		$.ajax({
			url: this.apiURL,
			type: 'GET',
			data: input,
			success: function (response) {
				mainContent.children().remove()
				mainContent.append(response.data.view)
			}
		})
	}
}

new Browse()
