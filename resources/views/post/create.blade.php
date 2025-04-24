<x-app-layout>
{{--    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">--}}
    <div class="form-container">
        <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data" class="form-box">
            @csrf
            <!-- Title -->
            <div class="form-group">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-input">
                <div class="form-error">
                    {{ $errors->first('title') }}
                </div>
            </div>
            <!-- File -->
            <div class="form-group">
                <label for="file" class="form-label">Add Image</label>
                <input type="file" id="file" name="file" class="form-input">
                <div class="form-error">
                    {{ $errors->first('file') }}
                </div>
            </div>
            <!-- Short Description -->
            <div class="form-group">
                <label for="short-description" class="form-label">Short Description</label>
                <textarea id="short-description" name="short_description" class="form-textarea">{{ old('short_description') }}</textarea>
                <div class="form-error">
                    {{ $errors->first('short_description') }}
                </div>
            </div>
            <!--Description -->
            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-textarea">{{ old('description') }}</textarea>
                <div class="form-error">
                    {{ $errors->first('description') }}
                </div>
            </div>
            <!-- Categories -->
            <div class="form-group">
                <label for="categories" class="form-label">Categories</label>
                <select multiple id="categories" name="categories[]" class="form-select">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <div class="form-error">
                    {{ $errors->first('categories') }}
                </div>
            </div>
            <!-- Enabled Comments -->
            <div class="form-group checkbox-group">
                <label for="comments" class="form-label">Comments Enabled?</label>
                <input type="checkbox" name="comments" value="enable" id="comments" checked class="form-checkbox">
            </div>
            <!-- Submit button -->
            <div class="form-group">
                <input type="submit" name="submit" value="Create" class="submit-button"/>
            </div>
        </form>
    </div>
</x-app-layout>
