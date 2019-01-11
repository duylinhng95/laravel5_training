require('./bootstrap.js')

window.submitCategory = function submitCategory() {
	var formData = $('#create').serialize();
	$.ajax({
		url: submitCategoryURI,
		type: "POST",
		data: formData,
		success: function (res) {
			if (res.code == 200) {
				$('#createModal').modal('hide');
				$('#notification').modal('show');
				$('#notification .modal-body .alert').html(res.message);
				$('#notification').on('hidden.bs.modal', function () {
					location.reload();
				})
			}
		}
	});
}

window.editCategory = function editCategory(id) {
	$.ajax({
		url: editCategoryURI + id,
		type: "GET",
		success: function (res) {
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
			if (res.code == 200) {
				$('#editModal').modal('hide');
				$('#notification').modal('show');
				$('#notification .modal-body .alert').html(res.message);
				$('#notification').on('hidden.bs.modal', function () {
					location.reload();
				})
			}
		}
	});
}

window.deleteCategory = function deleteCategory(id) {
	$.ajax({
		url: deleteCategoryURI + id,
		type: "DELETE",
		data: {_token: "{{csrf_token()}}"},
		success: function (res) {
			if (res.code == 200) {
				$('#notification').modal('show');
				$('#notification .modal-body .alert').html(res.message);
				$('#notification').on('hidden.bs.modal', function () {
					location.reload();
				})
			}
		}
	})
}
