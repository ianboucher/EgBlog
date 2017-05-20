@extends('layouts.app')

@section('content')
    <h1>Create a Post</h1>

    <hr/>

    <form method="POST" action="/posts">
        {{ csrf_field() }}

        <div class="form-group">
           <label for="title">Post Title</label>
           <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="body">Write your post</label>
            <textarea type="text" class="form-control" id="body" name="body" required> </textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>

    @include('partials.errors')

@endsection
