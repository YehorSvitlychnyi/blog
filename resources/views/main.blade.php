<x-app-layout>
    <div class="posts-grid">
        @forelse ($posts as $post)
            <div class="post-card">
                <h2 class="post-title"><a href="{{ route('post.show', $post->id) }}" >{{ $post->name }}</a></h2>
                @if($post->img_link)
                    <img src="{{ '/storage/' . $post->img_link }}" alt="{{ $post->name }}" class="post-image">
                @endif
                <div class="post-description">
                    {{ $post->short_description }}
                </div>
                <div class="post-categories">
                    <strong>Categories:</strong>
                    @foreach($post->categories as $category)
                        {{ $loop->first ? '' : ',' }} {{ ltrim($category->name, '-') }}
                    @endforeach
                </div>
                <div class="post-footer">
                    <a href="{{ route('post.show', $post->id) }}" class="post-button">Go to article</a>
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
    <div class="pagination-links">
        {{ $posts->links() }}
    </div>
</x-app-layout>
