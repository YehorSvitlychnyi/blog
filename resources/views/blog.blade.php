<x-app-layout>
    <div>
        <h1 class="blog-title">My blog</h1>
        <div class="blog-header">
            <a href="{{ route('post.create') }}" class="btn-create">Create a new post</a>
        </div>
        <div class="posts-grid">
            @forelse ($posts as $post)
                <div class="post-card">
                    <h2 class="post-title"><a href="{{ route('post.show', $post->id) }}">{{ $post->name }}</a></h2>
                    @if($post->img_link)
                        <img src="{{ asset('storage/' . $post->img_link) }}" alt="{{ $post->name }}" class="post-image">
                    @endif
                    <div class="post-description">
                        {{ $post->short_description }}
                    </div>
                    <div class="post-categories">
                        <strong>Categories:</strong>
                        @foreach($post->categories as $category)
                            {{ $loop->first ? '' : ', ' }}
                            {{ ltrim($category->name, '-') }}
                        @endforeach
                    </div>
                    <div class="post-footer">
                        <a href="{{ route('post.show', $post->id) }}" class="post-button">Go to article</a>
                        <a href="{{ route('post.edit', $post->id) }}" class="btn-edit">Edit</a>
                        <form action="{{ route('post.destroy', $post->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this post?')" >
                                Delete
                            </button>
                        </form>
                        <div class="post-reactions">
                            <div class="reaction">
                                <i class="fa-solid fa-thumbs-up"></i>
                                <span>{{ $post->likes_count }}</span>
                            </div>
                            <div class="reaction">
                                <i class="fa-solid fa-thumbs-down"></i>
                                <span>{{ $post->disLikes_count }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p>No posts available.</p>
            @endforelse
        </div>
    </div>
        <div class="pagination-links">
            {{ $posts->links() }}
        </div>
</x-app-layout>
