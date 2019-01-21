require('./bootstrap.js')

window.submitCategory = function submitCategory() {
	var formData = $('#create').serialize();
	$.ajax({
		url: submitCategoryURI,
		type: "POST",
		data: formData,
		success: function (res) {
			$('#createModal').modal('hide');
			$('#notification').modal('show');
			$('#notification .modal-body .alert').removeClass('alert-danger').addClass('alert-success');
			$('#notification .modal-body .alert').html(res.message);
			$('#notification').on('hidden.bs.modal', function () {
				location.reload();
			})
		},
		error: function (res) {
			var error = res.responseJSON;
			$('#error').append(error.errors.name[0]);
		}
	});
}

window.editCategory = function editCategory(id) {
	$.ajax({
		url: editCategoryURI + id,
		type: "GET",
		success: function (response) {
			var res = response.data;
			$('#editModal').modal('show');
			$('#editModal #edit').append("<input type='hidden' value=" + res.id + " name='categoryId'>");
			$('#editModal #edit #name').val(res.name);
		}
	})
}

window.saveCategory = function saveCategory() {
	var formData = $('#edit').serialize();
	$.ajax({
		url: saveCategoryURI,
		type: "PUT",
		data: formData,
		success: function (res) {
			$('#editModal').modal('hide');
			$('#notification').modal('show');
			$('#notification .modal-body .alert').removeClass('alert-danger').addClass('alert-success');
			$('#notification .modal-body .alert').html(res.message);
			$('#notification').on('hidden.bs.modal', function () {
				location.reload();
			})
		},
		error: function (res) {
			var error = res.responseJSON;
			$('#errorMsg').append(error.errors.name[0]);
		}
	});
}

window.deleteCategory = function deleteCategory(id) {
	$.ajax({
		url: deleteCategoryURI + id,
		type: "DELETE",
		data: {_token: csrfToken},
		success: function (res) {
			$('#notification').modal('show');
			$('#notification .modal-body .alert').removeClass('alert-danger').addClass('alert-success');
			$('#notification .modal-body .alert').html(res.message);
			$('#notification').on('hidden.bs.modal', function () {
				location.reload();
			})
		},
		error: function (res) {
			var error = res.responseJSON;
			$('#notification').modal('show');
			$('#notification .modal-body .alert').removeClass('alert-success').addClass('alert-danger');
			$('#notification .modal-body .alert').html(error.message);
		}
	})
}
