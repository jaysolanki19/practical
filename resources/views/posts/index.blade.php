@extends('layouts.app')

@section('content')
@section('title', 'Blog List')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('include.message')
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1>Blog Posts</h1>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add_post">
                    Create Post
                </button>
            </div>
            <form action="{{ route('posts.index') }}" method="GET" class="mb-3">    
                <div class="input-group">
                    <input name="search" type="text" id="search" class="form-control" placeholder="Search"  value="{{ $search }}" />
                    <button class="btn btn-primary" type="submit">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
                    <a href="{{route('posts.index')}}" class="btn btn-danger">Clear</a>
                </div>
            </form>
            <table class="table table-bordered">
                <thead>
                    <th>User Name</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th class="w-200">Action</th>
                </thead>
                <tbody>
                    @if ($posts->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center">No records found.</td>
                        </tr>
                    @else
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->description }}</td>
                                <td>
                                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                    @if (auth()->user()->id == $post->user_id)
                                        <button type="button" class="btn btn-info edit-post-btn" value="{{$post->id}}">
                                            <i class="fas fa-edit" aria-hidden="true"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger delete-post-btn" data-post-id="{{ $post->id }}">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>  
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            
        </div>
        <div class="d-flex justify-content-end">
            {{ $posts->links()}}
        </div>
    </div>
</div>

<!-- Create Post Modal -->
<div class="modal fade" id="add_post" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('posts.store') }}" id="addPostForm">
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
            </div>
        </div>
    </div>
</div>

<!-- Delete Post Modal -->
<div class="modal fade" id="delete_post_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this post?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="confirm_delete_btn">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Update Post Modal -->
<div class="modal fade" id="edit_post" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('posts.update') }}" id="editPostForm">
                    @csrf
                    <input type="hidden" id="post_id" name="post_id" value="post_id">
                    <div class="mb-3">
                        <label for="title" class="form-label">Post Title:</label>
                        <input type="text" name="title" id="post_title" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Post Description:</label>
                        <textarea name="description" id="post_description" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')
<script>
    $(document).ready(function (){
        $(document).on('click', '.edit-post-btn', function(){
            var post_id = $(this).val();
            $('#edit_post').modal('show');
            
            $.ajax({
                type: "GET",
                url: "/post/edit/" + post_id,
                success: function(response){
                    $('#post_title').val(response.post.title);
                    $('#post_description').val(response.post.description);
                    $('#post_id').val(response.post.id);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

@endsection
