<x-app-layout>
    <div>
        <h2>Edit post</h2>
        <form method="POST" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div>
                <div>
                    <label>Title:</label>
                    <input type="text" name="title" value="{{ $post->name }}" >
                </div>
                <div>
                    {{ $errors->first('title') }}
                </div>
            </div>
            <div>
                <div>
                    <label>Image:</label>
                    <img src="{{ asset('storage/' . $post->img_link) }}" alt="{{ $post->title }}">
                    <input type="file" name="img_link">
                </div>
                <div>
                    {{ $errors->first('file') }}
                </div>
            </div>
                <div>
                <div>
                    <label>Short description:</label>
                    <input type="text" name="short_description" value="{{ $post->short_description }}">
                </div>
                <div>
                    {{ $errors->first('short_description') }}
                </div>
            </div>
            <div>
                <div>
                    <label>Description:</label>
                    <textarea name="description" rows="5">{{ $post->description }}</textarea>
                </div>
                <div>
                    {{ $errors->first('description') }}
                </div>
            </div>
            <div>
                <label>Categories:</label>
                <select name="categories[]" multiple>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            @if(in_array($category->id, $post->categories->pluck('id')->toArray()))
                                selected
                            @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <div>
                    {{ $errors->first('categories') }}
                </div>
            </div>
            <button type="submit">
                Save
            </button>
        </form>
    </div>
</x-app-layout>
