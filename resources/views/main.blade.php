<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div>
            @forelse ($posts as $post)
                <div>
                    @if($post->img_link)
                        <img src="{{ '/storage/' . $post->img_link }}"
                             alt="">
                    @endif
                    <h2><a href="{{ route('post.show', $post->id) }}" >
                            {{ $post->name }}
                        </a>
                    </h2>
                    <p>{{ $post->short_description }}</p>
                    <p>
                        <strong>Categories:</strong>
                        @foreach($post->categories as $category)
                            {{ $loop->first ? '' : ',' }} {{ ltrim($category->name, '-') }}
                        @endforeach
                    </p>
                    <div >
                        {{-- Лайк --}}
                        <i class="fa-solid fa-thumbs-up"></i>
                        <span>{{ $post->likes_count }}</span>
                        <i class="fa-solid fa-thumbs-down"></i>
                        <span>{{ $post->disLikes_count }}</span>
                    </div>
                    <a href="{{ route('post.show', $post->id) }}">
                        Go to article
                    </a>
                </div>
            @empty
                <p >No posts available.</p>
            @endforelse
        </div>
        {{-- Пагінація --}}
        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
