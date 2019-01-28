require('./vendor/template.js')

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
			searchField: $("#search"),
			params: location.search,
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
	}

	listen() {
		this.buttonSort()
		this.importUser()
		this.btnSearchEnter(this.element.btnSearchPost)
		this.onSearch(this.element.btnSearchPost)
		this.btnSearchEnter(this.element.btnSearchUser)
		this.onSearch(this.element.btnSearchUser)
		this.sortButtonPress()
	}

	importUser() {
		let url = `${this.originURL}/admin/user/import`
		this.element.btnImportUser.on('click', function () {
			$.ajax({
				url: url,
				type: "GET",
				success: function () {

				}
			})
		})
	}

	onSearch(name) {
		let input = this.element.searchField
		name.on('click', function (event) {
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

	sortButtonPress(){
		let params = new URLSearchParams(this.element.params)
		$.each(this.section, function(key, value) {
			value.on('click', function(event) {
				let section = event.currentTarget.children[1].value
				if (params.get('order') == 'desc') {
					window.location.href = "/admin?sort=" + section + "&order=asc";
				} else {
					window.location.href = "/admin?sort=" + section + "&order=desc";
				}
			})
		})
	}

	buttonSort() {
		let urlParams = new URLSearchParams(window.location.search);
		let order = urlParams.getAll('order');
		let section = urlParams.get('sort');
		let button = $('#' + section)
		if (order == 'desc') {
			button.removeClass('fa-arrow-up');
			button.addClass('fa-arrow-down');
		} else {
			button.removeClass('fa-arrow-down');
			button.addClass('fa-arrow-up');
		}
	}
}

new Admin()
