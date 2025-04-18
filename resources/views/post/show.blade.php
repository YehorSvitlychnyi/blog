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
        <i class="fa-regular fa-thumbs-up"></i>
        <span>{{ $likes }}</span>
        <i class="fa-regular fa-thumbs-down"></i>
        <span>{{ $dislikes }}</span>
        <div>
            <form action="{{ route('comment.store', $post->id) }}" method="post">
                @csrf
                <label for="comment"></label>
                <input type="text" id="comment" name="comment">
                <input type="submit">
            </form>
            @forelse($comments as $comment)
                <div>
                    <p>{{ $comment->user_id }}</p>
                    <p>{{ $comment->name }}</p>
                    <p>{{ $comment->updated_at }}</p>
                </div>
            @empty
                    <p>No comments</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
