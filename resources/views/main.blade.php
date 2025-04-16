<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Blog Posts</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($posts as $post)
                <div class="bg-white shadow rounded-lg p-4">
                    @if($post->img_link)
                        <img src="{{ asset('storage/' . $post->img_link  ) }}" class="w-full h-48 object-cover rounded mb-4" alt="{{ $post->name }}">
                    @endif
                    <h2 class="text-xl font-semibold mb-2">{{ $post->name }}</h2>
                    <p class="text-gray-700 text-sm mb-2">{{ $post->short_description }}</p>

                    <p class="text-xs text-gray-500 mb-2">
                        <strong>Categories:</strong>
                        @foreach($post->categories as $category)
                            {{ $loop->first ? '' : ',' }} {{ $category->name }}
                        @endforeach
                    </p>

                    <div class="flex items-center justify-between text-sm text-gray-600 mb-2">
                        <span>👍 {{ $post->likes ?? 0 }}</span>
                        <span>👎 {{ $post->dislikes ?? 0 }}</span>
                    </div>

                    <div class="mb-2">
                        <strong>Rating:</strong>
                        @for ($i = 1; $i <= 5; $i++)
                            @if($i <= ($post->rating ?? 0))
                                ⭐
                            @else
                                ☆
                            @endif
                        @endfor
                    </div>

                    <a href="#" class="inline-block mt-2 px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Go to article</a>
                </div>
            @empty
                <p class="col-span-3">No posts available.</p>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>

