<x-app-layout>
    <div class="form-container">
        <form method="POST" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data" class="form-box">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title" class="form-label">Title:</label>
                <input type="text" name="title" id="title" value="{{ old('title', $post->name) }}" class="form-input">
                <div class="form-error">
                    {{ $errors->first('title') }}
                </div>
            </div>
            <div class="form-group">
                <label for="file" class="form-label">Image:</label>
                <img src="{{ asset('storage/' . $post->img_link) }}" alt="{{ $post->title }}">
                <input type="file" id="file" name="img_link" class="form-input">
                <div class="form-error">
                    {{ $errors->first('file') }}
                </div>
            </div>
            <div class="form-group">
                <label for="short-description" class="form-label">Short description:</label>
                <textarea id="short-description" name="short_description" class="form-textarea">{{ old('short_description', $post->short_description) }}</textarea>
                <div class="form-error">
                    {{ $errors->first('short_description') }}
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="form-label">Description:</label>
                <textarea name="description" id="description" rows="5" class="form-textarea">{{ old('description', $post->description) }}</textarea>
                <div class="form-error">
                    {{ $errors->first('description') }}
                </div>
            </div>
            <div class="form-group">
                <label for="categories" class="form-label">Categories:</label>
                <select id="categories" name="categories[]" multiple class="form-select">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            @if(in_array($category->id, $post->categories->pluck('id')->toArray()))
                                selected
                            @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <div class="form-error">
                    {{ $errors->first('categories') }}
                </div>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Save" class="submit-button"/>
            </div>
        </form>
    </div>
</x-app-layout>
