<x-app-layout>
    <div class="form-container">
        <form action="{{route('category.store')}}" method="post" class="form-box">
            @csrf
            <div class="form-group">
                <label for="category" class="form-label">Add new category</label>
                <input type="text" name="category" id="category" class="form-input">
                <div class="form-error">
                    {{$errors->first('category')}}
                </div>
            </div>

            <div class="form-group">
                <label for="parent_category" class="form-label">Categories:</label>
                <select id="parent_category" name="parent_category" class="form-select-category">
                    <option value="{{null}}"></option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <div class="form-error">
                    {{ $errors->first('parent_category') }}
                </div>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Create" class="submit-button"/>
            </div>
        </form>
    </div>
</x-app-layout>
