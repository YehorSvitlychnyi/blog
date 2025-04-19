<x-app-layout>
    <div style="width: 50%; margin: 0 auto">
        <h2>{{ $post->name }}</h2>
        <img src="{{ asset('storage/' . $post->img_link) }}" alt="{{ $post->title }}">
        <pre>{{ $post->description }}</pre>
        <ul>
            <li>Categories:</li>
        @foreach($post->categories as $category)
            <li>{{ $category->name }}</li>
        @endforeach
        </ul>
        <form action="{{ route('rating.index', $post->id) }}" method="post">
            @csrf

            <button name="liked" value="1"><i class="fa-{{ $like===null?'regular':'solid' }} fa-thumbs-up"></i>{{ $likes }}</button>
            <button name="liked" value="0"><i class="fa-{{ $dislike===null?'regular':'solid' }} fa-thumbs-down"></i>{{ $dislikes }}</button>
        </form>

        <div>
            @if($post->comment_enabled)
                <form action="{{ route('comment.store', $post->id) }}" method="post">
                    @csrf
                    <label for="comment">Comment</label>
                    <input type="text" id="comment" name="name" value="{{ old('name') }}">
                    <input type="submit">
                </form>
                @forelse($comments as $comment)
                    <div>
                        <p>{{ \App\Models\User::findById($comment->user_id)  }}</p>
                        <p>{{ $comment->name }}</p>
                        <p>{{ $comment->updated_at }}</p>
                        <a href="{{ route('comment.edit', $comment->id) }}">Edit</a>
                        <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="delete">
                        </form>
                    </div>
                @empty
                        <p>No comments</p>
                @endforelse
            @else
                <p>Comments are not allowed</p>
            @endif
        </div>
    </div>
</x-app-layout>
