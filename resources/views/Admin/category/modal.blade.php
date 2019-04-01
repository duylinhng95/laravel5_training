{{--Create Modal--}}
<div class="modal fade" id="createModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add new Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="create">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="name"> Category Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" onsubmit="submitCategory()">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{--Notification--}}
<div class="modal fade" id="notification">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success"></div>
            </div>
        </div>
    </div>
</div>
{{--Edit Modal--}}
<div class="modal fade" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add new Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <input type="text" name="name" class="form-control" id="name">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveCategory()">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
	function submitCategory() {
		var formData = $('#create').serialize();
		$.ajax({
			url: "{{url('/admin/category')}}",
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

	function editCategory(id) {
		$.ajax({
			url: "{{url('/admin/category')}}/" + id,
			type: "GET",
			success: function (res) {
				$('#editModal').modal('show');
				$('#editModal #edit').append("<input type='hidden' value=" + res.id + " name='categoryId'>");
				$('#editModal #edit #name').val(res.name);
			}
		})
	}

	function saveCategory() {
		var formData = $('#edit').serialize();
		$.ajax({
			url: "{{url('/admin/category')}}",
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

	function deleteCategory(id) {
		$.ajax({
			url: "{{url('/admin/category')}}/" + id,
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
</script>
