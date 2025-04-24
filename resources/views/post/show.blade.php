<x-app-layout>
    <div class="single-post-wrapper">
        <h2 class="single-post-title">{{ $post->name }}</h2>
        <img class="single-post-image" src="{{ asset('storage/' . $post->img_link) }}" alt="{{ $post->title }}">
        <pre class="single-post-description">{{ $post->description }}</pre>
        <ul class="single-post-categories">
            <li class="category-header">Categories:</li>
        @foreach($post->categories as $category)
            <li class="category-item">{{ $category->name }}</li>
        @endforeach
        </ul>
        <form action="{{ route('rating.index', $post->id) }}" method="post"  class="post-reaction-form">
            @csrf

            <button name="liked" value="1" class="reaction-button"><i class="fa-{{ $like===null?'regular':'solid' }} fa-thumbs-up"></i>{{ $likes }}</button>
            <button name="liked" value="0" class="reaction-button"><i class="fa-{{ $dislike===null?'regular':'solid' }} fa-thumbs-down"></i>{{ $dislikes }}</button>
        </form>

        <div class="comments-section">
            @if($post->comment_enabled)
                <form action="{{ route('comment.store', $post->id) }}" method="post" class="comment-form">
                    @csrf
                    <label for="comment" class="comment-label">Comment</label>
                    <input type="text" id="comment" name="name" value="{{ old('name') }}" class="comment-input">
                    <input type="submit" class="comment-submit">
                </form>
                @forelse($comments as $comment)
                    <div class="comment-card">
                        <p class="comment-user">{{ \App\Models\User::findById($comment->user_id)  }}</p>
                        <p class="comment-text">{{ $comment->name }}</p>
                        <p class="comment-time">{{ $comment->updated_at }}</p>
                        @can('update', $comment)
                            <a href="{{ route('comment.edit', $comment->id) }}" class="btn-comment-edit">Edit</a>
                        @endcan
                        @can('delete', $comment)
                            <form action="{{ route('comment.destroy', $comment->id) }}" method="post" class="comment-delete-form">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="delete" class="comment-delete-button">
                            </form>
                        @endcan
                    </div>
                @empty
                    <p class="no-comments">No comments</p>
                @endforelse
            @else
                <p class="comments-disabled">Comments are not allowed</p>
            @endif
        </div>
    </div>
</x-app-layout>
