<x-app-layout>
<form action="{{route('category.store')}}" method="post">
    @csrf
    <label for="category"></label>
    <input type="text" name="category" id="category">
    <div>
        {{$errors->first('category')}}
    </div>
    <div>
        <label for="parent_category">Categories</label>
        <select id="parent_category" name="parent_category">
            <option value="{{null}}"></option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <div>
            {{ $errors->first('parent_category') }}
        </div>
    </div>
    <button type="submit">Submit</button>
</form>
</x-app-layout>
