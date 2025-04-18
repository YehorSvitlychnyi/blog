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
{{--        <form action="" method="post">--}}
{{--            @csrf--}}
{{--            @method('PUT')--}}
{{--            <a href="{{ route('rating.create', $post->id) }}">--}}
{{--                <i class="fa-regular fa-thumbs-up"></i>--}}
{{--            </a>--}}
{{--            <span>{{ $likes }}</span>--}}
{{--            <a href="">--}}
{{--                <i class="fa-regular fa-thumbs-down"></i>--}}
{{--            </a>--}}
{{--            <span>{{ $dislikes }}</span>--}}
{{--        </form>--}}

        <div>
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
        </div>
    </div>
</x-app-layout>
