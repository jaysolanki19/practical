@extends('layouts.app')
@section('title', 'Blog Details')

   
@section('content')
<div class="container ">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            @include('include.message')
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1></h1>
                <a href="{{ route('posts.index') }}" class="btn btn-primary align-right mb-3">Back</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center text-success">Blog post</h3>
                    
                    <br/>
                    <h2>{{ $post->title }}</h2>
                    <p>
                        {{ $post->description }}
                    </p>
                    <hr />
                    <h4>Comments</h4>
  
                    @include('comments.display_comments',['comments' => $post->comments, 'post_id' => $post->id])

                    <hr />
                    <h4>Add comment</h4>
                    <form method="post" action="{{ route('comments.store') }}" id="addCommentForm">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="comment"></textarea>
                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success mt-2" value="Add Comment" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
