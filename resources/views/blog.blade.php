<x-app-layout>
    <a href="{{ route('post.create') }}" style="display: inline-block; background-color: #4CAF50; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; margin-bottom: 10px;">
        Create a new post
    </a>
    <div>
        <h1 style="font-size: 24px; font-weight: bold; margin-bottom: 15px;">
            My blog
        </h1>
        <div>
            @forelse ($posts as $post)
                <div style="margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
                    @if($post->img_link)
                        <img src="{{ asset('storage/' . $post->img_link) }}" alt="{{ $post->name }}" style="max-width: 100%; height: auto; margin-bottom: 10px;">
                    @endif
                    <div >
                        {{-- Лайк --}}
                        <i class="fa-solid fa-thumbs-up"></i>
                        <span>{{ $post->likes_count }}</span>
                        <i class="fa-solid fa-thumbs-down"></i>
                        <span>{{ $post->disLikes_count }}</span>
                    </div>
                    <h2 style="font-size: 20px; font-weight: bold; margin-bottom: 5px;">
                        <a href="{{ route('post.show', $post->id) }}" style="color: #007bff; text-decoration: none;">
                            {{ $post->name }}
                        </a>
                    </h2>
                    <p style="color: #6c757d; margin-bottom: 8px;">
                        {{ $post->short_description }}
                    </p>
                    <p style="color: #6c757d; margin-bottom: 8px;">
                        <strong>Категорії:</strong>
                        @foreach($post->categories as $category)
                            {{ $loop->first ? '' : ', ' }}
                            {{ ltrim($category->name, '-') }}
                        @endforeach
                    </p>
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <a href="{{ route('post.edit', $post->id) }}" style="display: inline-block; background-color: #ffc107; color: white; padding: 8px 12px; text-decoration: none; border-radius: 5px;">
                            Edit
                        </a>

                        <form action="{{ route('post.destroy', $post->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 8px 12px; border-radius: 5px; cursor: pointer;"
                                    onclick="return confirm('Ви впевнені, що хочете видалити цей пост?')">
                                Delete
                            </button>
                        </form>
                    </div>
                    <a href="{{ route('post.show', $post->id) }}" style="display: inline-block; margin-top: 10px; color: #007bff; text-decoration: none;">
                        Перейти до статті
                    </a>
                </div>
            @empty
                <p style="color: #6c757d;">У вас ще немає жодного поста.</p>
            @endforelse
        </div>
        <div style="margin-top: 24px;">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
