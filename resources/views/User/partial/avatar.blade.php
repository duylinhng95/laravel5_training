<div class="modal fade" id="avatarModal" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            </div>
            <form id="avatarForm" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="#preview_image">Preview Image</label>
                        <img src="{{asset($user->avatar)}}" id="previewImage" class="img-circle">
                    </div>
                    <div class="form-group">
                        <label for="avatar_img">New Image</label>
                        <input type="file" name="avatar_img" id="avatarInput" data-user-id="{{$user->id}}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
