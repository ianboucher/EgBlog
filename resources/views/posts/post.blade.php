<div class="blog-post">

    <h2 class="blog-post-title">
        <a href="/posts/{{ $post->id }}">
            {{ $post->title }}
        </a>
    </h2>

    <div class="blog-post-meta">
        <p>
            {{ $post->created_at->toFormattedDateString() }} by {{ $post->user->name }}
        </p>

        @if(count($post->tags))
            @foreach ($post->tags as $tag)
                <span class="badge badge-info">
                    <a class="text-white" href="/posts/tags/{{ $tag->name }}">{{ $tag->name }}</a>
                </span>
            @endforeach
        @endif
    </div>

    <p>{{ $post->body }}</p>
</div><!-- /.blog-post -->
