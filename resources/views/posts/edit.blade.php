<form method="post" action="{{ route('posts.update') }}" id="edit_post_form">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Post Title:</label>
        <input type="text" name="title" id="title" class="form-control" />
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Post Description:</label>
        <textarea name="description" id="description" rows="5" class="form-control"></textarea>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
  