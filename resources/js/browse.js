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
			filterWidget: $(".browse-widget-filter"),
			mainContent: $("#mainContent"),
			categoryWidget: $(".browse-widget-category"),
			tagsWidget: $(".browse-widget-tags"),
			filterData: {
				keywords: "",
				sort: "",
				filter: {
					category: [],
					tags: [],
				}
			}
		}
		this.apiURL = location.origin + '/api/browse'
	}

	listen() {
		this.btnSearchEnter(this.element.btnSearchPost, this.element.keywordsPost)
		this.onSearch(this.element.btnSearchPost, this.element.keywordsPost)
		this.checkSearchInput()
		this.filterBrowsePost()
		this.radioButtonFilter(this.element.categoryWidget)
		this.radioButtonFilter(this.element.tagsWidget)
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

	checkSearchInput() {
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
				if (response === undefined) {
					mainContent.children().remove()
					mainContent.append(`<div class="post row notification-heading">
			        <h2>Post not found. Please choose different keywords</h2>
			    </div>`)
				} else {
					mainContent.children().remove()
					mainContent.append(response.data.view)
				}
			}
		})
	}

	filterBrowsePost() {
		let filterButton = this.element.filterWidget.children()
		let self = this
		let data = this.element.filterData
		filterButton.each(function (key, value) {
			$(value).find('a').on('click', function (event) {
				let input = self.checkInputNull()
				if (input) {
					let target = event.currentTarget
					data.keywords = input
					data.sort = $(target).data('type')
					let childElement = $(target).find('i')
					if (childElement.hasClass('fa-arrow-down')) {
						data.order = 'asc'
						childElement.removeClass('fa-arrow-down')
						childElement.addClass('fa-arrow-up')
					} else {
						data.order = 'desc'
						childElement.removeClass('fa-arrow-up')
						childElement.addClass('fa-arrow-down')
					}
					self.callAjaxApi(data)
				}
			})
		})
	}

	checkInputNull() {
		let input = this.element.keywordsPost.val()
		let mainContent = this.element.mainContent
		if (input !== '') {
			return input
		} else {
			mainContent.children().remove()
			mainContent.append(`<div class="post row notification-heading">
			        <h2>Please type in something for searching</h2>
			    </div>`)
			return false;
		}
	}

	radioButtonFilter(section) {
		let widgetSection = section.children().find('input')
		let data = this.element.filterData
		let sectionData = data.filter.tags
		let self = this

		if (section.hasClass("browse-widget-category")) {
			sectionData = data.filter.category
		}

		widgetSection.each(function (key, value) {
			$(value).change(function () {
				if ($(value).prop('checked') === true) {
					sectionData.push($(value).val())
				} else {
					let pos = sectionData.indexOf($(value).val())
					sectionData.splice(pos, 1)
				}
			})
		})

		widgetSection.change(function () {
			let input = self.checkInputNull()

			if (input) {
				data.keywords = input
			}

			self.callAjaxApi(data)
		})
	}
}

new Browse()
