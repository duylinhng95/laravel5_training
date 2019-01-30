
class Category {
	constructor() {
		this.init();
	}

	init() {
		this.config();
		this.listen();
	}

	config() {
		this.element = {
			create: $("#createModal"),
			edit: $("#editModal"),
			form: {
				create: $("#form-create"),
				edit: $("#edit"),
			},
			btnSubmitCreate: $("#btnSubmitAddCategory"),
			btnShowEdit: $(".btn-show-edit-category"),
			btnSubmitEdit: $("#btnSubmitEditCategory"),
			btnDelete: $(".btn-delete-category"),
		};
		this.notification = window.toastr;
		this.notification.options = {
			"preventDuplicates": true,
			"showDuration": "3",
			"hideDuration": "3",
			"timeOut": "600",
		}
		this.apiURL = location.origin;
	}

	listen() {
		this.submitAddCategory();
		this.showEditCategory();
		this.submitEditCategory();
		this.deleteCategory();
	}

	submitAddCategory() {
		let url = `${this.apiURL}/admin/category`;
		let createModal = this.element.create;
		let formData = this.element.form.create;
		let notification = this.notification;

		formData.validate({
			rules: {
				"name": {
					required: true,
					maxlength: 25
				}
			},
			messages: {
				name: {
					required: "Name is required",
					maxlength: "Name must be less than 25 characters"
				}
			}
		});
		this.element.btnSubmitCreate.on('click', function (event) {
			if (formData.valid()) {
				$.ajax({
					url: url,
					type: "POST",
					data: formData.serialize(),
					success: function (res) {
						createModal.modal('hide')
						notification.options.onHidden = function() { location.reload() }
						notification.success(res.message)
					}
				})
			}
		})
	}

	showEditCategory() {
		let editModal = this.element.edit;
		let editForm = this.element.form.edit;
		const url = `${this.apiURL}`
		this.element.btnShowEdit.on('click', function (event) {
			let input = event.target;
			let id = input.children.categoryId.value
			var urlAPI = `${url}/admin/category/${id}`
			$.ajax({
				url: urlAPI,
				type: "GET",
				success: function (res) {
					editModal.modal('show');
					editForm.append(`<input type="hidden" value="${res.data.id}" name="categoryId">`);
					editForm.find('input[name=name]').val(res.data.name);
				}
			})
		})
	}

	submitEditCategory() {
		let url = `${this.apiURL}/admin/category`;
		let editModal = this.element.edit
		let editForm = this.element.form.edit
		let notification = this.notification
		editForm.validate({
			rules: {
				"name": {
					required: true,
					maxlength: 25
				}
			},
			messages: {
				required: "Name is required",
				maxLength: "Name must be less than 25 characters"
			}
		})
		this.element.btnSubmitEdit.on('click', function (event) {
			if (editForm.valid()) {
				let formData = editForm.serialize();
				$.ajax({
					url: url,
					type: "PUT",
					data: formData,
					success: function (res) {
						notification.options.onHidden = function() { location.reload() }
						editModal.modal('hide')
						notification.success(res.message)
					}
				})
			}
		})
	}

	deleteCategory() {
		const url = `${this.apiURL}/admin/category`;
		let notification = this.notification
		this.element.btnDelete.on('click', function (event) {
			//Get current Node for remove category in view
			let input = event.target;
			let currentNode = input.parentNode.parentNode
			let tbody = currentNode.parentNode
			let id = input.children.categoryId.value
			let token = input.children[1].value
			let urlAPI = `${url}/${id}`

			//Ajax request
			$.ajax({
				url: urlAPI,
				type: "DELETE",
				data: {_token: token},
				success: function (res) {
					tbody.removeChild(currentNode)
					notification.success(res.message);
				},
				error: function (res) {
					var error = res.responseJSON;
					notification.error(error.message);
				}
			})
		})
	}
}
new Category();
