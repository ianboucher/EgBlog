@extends ('layouts.app')

@section ('content')
    @include('posts.post')

    <hr/>
    <div class="comments">
        <ul class="list-group">

            @foreach($post->comments as $comment)
                <li class="list-group-item">
                    <strong> {{ $comment->created_at->diffForHumans() }}: &nbsp </strong>
                    {{ $comment->body }}
                </li>
            @endforeach

            <div class="card">
                <div class="card-block">
                    <form method="POST" action="/posts/{{ $post->id }}/comments">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <textarea class="form-control" name="body" placeholder="Your comment here..." required></textarea>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>

                    @include('partials.errors')
                </div>
            </div>

        </ul>
    </div>

@endsection
