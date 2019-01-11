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
                <button type="button" class="btn btn-primary" onclick="submitCategory()">Save changes</button>
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
	var submitCategoryURI = "{{url('/admin/category')}}";
	var editCategoryURI   = "{{url('/admin/category')}}/";
	var saveCategoryURI   = "{{url('/admin/category')}}";
	var deleteCategoryURI = "{{url('/admin/category')}}/";
</script>
