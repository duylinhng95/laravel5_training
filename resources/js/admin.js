require('./vendor/template.js')
require('./bootstrap')
require('jquery-validation/dist/additional-methods')
import Chart from "./chart.js"

class Admin {
	constructor() {
		this.init()
	}

	init() {
		this.config()
		this.listen()
	}

	config() {
		this.element = {
			btnImportUser: $("#btnImportUser"),
			btnSearchUser: $("#searchBtnUser"),
			btnSearchPost: $("#searchPostBtn"),
			btnSearchWord: $("#searchWordsBtn"),
			btnSubmitFileWord: $("#btnSubmitFileWord"),
			fileForm: $("#submitFileForm"),
			searchField: $("#search"),
			params: location.search,
			loader: $("#loader"),
			btnBlock: $(".btn-block"),
			actionDropdown: $(".action-dropdown"),
		}
		this.section = {
			title: $("#titleSort"),
			category: $("#categorySort"),
			user: $("#userSort"),
			deleted_at: $("#deletedAtSort"),
			email: $("#emailSort"),
			status: $("#statusSort"),
			name: $("#nameSort"),

		}
		this.apiURL = location.href
		this.originURL = location.origin
		this.pathName = location.pathname
	}

	listen() {
		this.buttonSort()
		this.importUser()
		this.btnSearchEnter(this.element.btnSearchWord)
		this.onSearch(this.element.btnSearchWord)
		this.btnSearchEnter(this.element.btnSearchPost)
		this.onSearch(this.element.btnSearchPost)
		this.btnSearchEnter(this.element.btnSearchUser)
		this.onSearch(this.element.btnSearchUser)
		this.sortButtonPress()
		this.checkNoData()
		this.setActiveClass()
		this.validateFileWord()
		this.blockUser(this.element.btnBlock)
		new Chart()
	}

	importUser() {
		let url = `${this.originURL}/admin/user/import`
		let self = this
		this.element.btnImportUser.on('click', function () {
			self.element.loader.html(`
						<td colspan="6" align="center">
                <span class="dashboard-spinner spinner-primary spinner-lg"></span>
            </td>
			`)
			$.ajax({
				url: url,
				type: "GET",
				success: function () {
					location.reload()
				}
			})
		})
	}

	onSearch(name) {
		let input = this.element.searchField
		name.on('click', function () {
			let url = location.pathname
			input = input.val()
			window.location.href = `${url}?keywords=${input}`
		})
	}

	btnSearchEnter(name) {
		let btnSearch = name
		this.element.searchField.keypress(function (event) {
			if (event.which === 13) {
				btnSearch.click()
			}
		})
	}

	sortButtonPress() {
		let params = new URLSearchParams(this.element.params)
		let url = `${this.pathName}?`
		$.each(this.section, function (key, value) {
			value.on('click', function (event) {
				let section = event.currentTarget.children[1].value
				if (params.get('order') === 'desc') {
					params.set('sort', section)
					params.set('order', 'asc')
					location.href = url + params.toString()
				} else {
					params.set('sort', section)
					params.set('order', 'desc')
					location.href = url + params.toString()
				}
			})
		})
	}

	buttonSort() {
		let urlParams = new URLSearchParams(window.location.search);
		let order = urlParams.getAll('order');
		let section = urlParams.get('sort');
		let button = $('#' + section)
		if (order === 'desc') {
			button.removeClass('fa-arrow-up');
			button.addClass('fa-arrow-down');
		} else {
			button.removeClass('fa-arrow-down');
			button.addClass('fa-arrow-up');
		}
	}

	checkNoData() {
		let tbody = $("tbody")
		if (tbody.children().length === 0) {
			tbody.append(`<td colspan="6" align="center">
                No data is found
            </td>`)
		}
	}

	setActiveClass() {
		let url = location.href
		$(".nav-link").each(function () {
			if($(this).hasClass("nav-index"))
			{
				if(url === this.href)
				{
					return $(this).addClass('active')
				}
			} else {
				if (url.includes(this.href)) {
					$(this).addClass('active')
				}
			}
		})
	}

	validateFileWord() {
		let formData = this.element.fileForm
		formData.validate({
			rules: {
				banned_words: {
					required: true,
					extension: "csv"
				}
			},
			messages: {
				banned_words: {
					required: "File is required",
					extension: "File must be csv extension"
				}
			},
			submitHandler: function (form) {
				form.submit();
			}
		})
	}

	blockUser(button) {
		let self = this
		button.on('click', function () {
			let target = this
			let userId = $(target).data('user-id')
			$.ajax({
				url: self.originURL + "/api/change-status",
				data: {id: userId},
				method: "get",
				success: function (res) {
					let statusSection = $(target).parents("#action").parent().children('#userStatus')
					let status = res.data.status
					if(status === "Block")
					{
						$(target).removeClass("btn-danger")
						$(target).addClass("btn-success")
						$(target).html("Unblock")
					} else {
						$(target).removeClass("btn-success")
						$(target).addClass("btn-danger")
						$(target).html("Block")

					}

					statusSection.html(status)
				}
			})
		})
	}
}

new Admin()
