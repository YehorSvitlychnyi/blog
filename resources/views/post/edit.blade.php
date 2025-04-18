<x-app-layout>
{{--    <div>--}}
{{--        <h1>Редагувати пост</h1>--}}

{{--        <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">--}}
{{--            @csrf--}}
{{--            @method('PUT')--}}

{{--            <div>--}}
{{--                <label for="title">Заголовок:</label>--}}
{{--                <input type="text" id="title" name="title" value="{{ old('title', $post->name) }}">--}}
{{--                @error('title')--}}
{{--                <div>{{ $message }}</div>--}}
{{--                @enderror--}}
{{--            </div>--}}

{{--            <div>--}}
{{--                <label for="short_description">Короткий опис:</label>--}}
{{--                <textarea id="short_description" name="short_description">{{ old('short_description', $post->short_description) }}</textarea>--}}
{{--                @error('short_description')--}}
{{--                <div>{{ $message }}</div>--}}
{{--                @enderror--}}
{{--            </div>--}}

{{--            <div>--}}
{{--                <label for="description">Опис:</label>--}}
{{--                <textarea id="description" name="description">{{ old('description', $post->description) }}</textarea>--}}
{{--                @error('description')--}}
{{--                <div>{{ $message }}</div>--}}
{{--                @enderror--}}
{{--            </div>--}}

{{--            <div>--}}
{{--                <label for="file">Зображення:</label>--}}
{{--                @if($post->img_link)--}}
{{--                    <div>--}}
{{--                        <img src="{{ asset('storage/' . $post->img_link) }}" alt="{{ $post->name }}" style="max-width: 200px; height: auto;">--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                <input type="file" id="file" name="file">--}}
{{--                @error('file')--}}
{{--                <div>{{ $message }}</div>--}}
{{--                @enderror--}}
{{--            </div>--}}

{{--            <div>--}}
{{--                <label>Категорії:</label>--}}
{{--                <div>--}}
{{--                    @foreach($categories as $category)--}}
{{--                        <div>--}}
{{--                            <input type="checkbox" name="categories[]" value="{{ $category->id }}"--}}
{{--                                {{ in_array($category->id, $postCategories) ? 'checked' : '' }}>--}}
{{--                            <label for="category_{{ $category->id }}">{{ ltrim($category->name, '-') }}</label>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                    @error('categories')--}}
{{--                    <div>{{ $message }}</div>--}}
{{--                    @enderror--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div>--}}
{{--                <label for="comments">Дозволити коментарі:</label>--}}
{{--                <input type="checkbox" id="comments" name="comments" {{ old('comments', $post->comment_enabled) ? 'checked' : '' }}>--}}
{{--            </div>--}}

{{--            <div>--}}
{{--                <button type="submit">Зберегти зміни</button>--}}
{{--                <a href="{{ route('my_blog') }}">Скасувати</a>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}
</x-app-layout>
