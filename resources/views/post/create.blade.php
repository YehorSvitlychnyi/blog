<x-app-layout>
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
            @csrf
            <!-- Title -->
            <div>
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}">
                <div>
                    {{ $errors->first('title') }}
                </div>
            </div>
            <!-- File -->
            <div>
                <label for="file">Add Image</label>
                <input type="file" id="file" name="file">
                <div>
                    {{ $errors->first('file') }}
                </div>
            </div>
            <!-- Short Description -->
            <div>
                <label for="short-description">Short Description</label>
                <input type="text" id="short-description" name="short_description" value="{{ old('short-description') }}">
                <div>
                    {{ $errors->first('short_description') }}
                </div>
            </div>
            <!--Description -->
            <div>
                <label for="description">Description</label>
                <input type="text" id="description" name="description" value="{{ old('description') }}">
                <div>
                    {{ $errors->first('description') }}
                </div>
            </div>
            <!-- Categories -->
            <div>
                <label for="categories">Categories</label>
                <select multiple id="categories" name="categories[]">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <div>
                    {{ $errors->first('categories') }}
                </div>
            </div>
            <!-- Enabled Comments -->
            <div>
                <label for="comments">Comments Enabled?</label>
                <input type="checkbox" name="comments" value="enable" id="comments" checked>
            </div>
            <!-- Submit button -->
            <div>
                <input type="submit" name="submit" value="Create"/>
            </div>



{{--            <!-- Title -->--}}
{{--            <div>--}}
{{--                <x-input-label for="title" :value="__('title')" />--}}
{{--                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus autocomplete="title" />--}}
{{--                <x-input-error :messages="$errors->get('title')" class="mt-2" />--}}
{{--            </div>--}}
{{--            <!-- Image -->--}}
{{--            <div>--}}
{{--                <x-input-label for="title" :value="__('Name')" />--}}
{{--                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus autocomplete="title" />--}}
{{--                <x-input-error :messages="$errors->get('title')" class="mt-2" />--}}
{{--            </div>--}}
{{--            <!-- Select -->--}}
{{--            <div>--}}
{{--                <x-input-label for="categories" :value="__('categories')" />--}}
{{--                <x-form-select class="block mt-1 w-full" name="interests[]" :options="['Economy','History']" label="Select your interests" multiple />--}}
{{--                <x-input-error :messages="$errors->get('categories')" class="mt-2" />--}}
{{--            </div>--}}

{{--            <!-- Short descripion -->--}}
{{--            <div>--}}
{{--                <x-input-label for="short-description" :value="__('short-description')" />--}}
{{--                <x-text-input id="short-description" class="block mt-1 w-full" type="text" name="short-description" :value="old('short-description')" required autofocus autocomplete="short-description" />--}}
{{--                <x-input-error :messages="$errors->get('short-description')" class="mt-2" />--}}
{{--            </div>--}}
{{--            <!-- Descripion -->--}}
{{--            <div>--}}
{{--                <x-input-label for="description" :value="__('description')" />--}}
{{--                <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required autofocus autocomplete="description" />--}}
{{--                <x-input-error :messages="$errors->get('description')" class="mt-2" />--}}
{{--            </div>--}}
{{--            <x-primary-button class="ms-4">--}}
{{--                {{ __('Create') }}--}}
{{--            </x-primary-button>--}}
        </form>
    </div>
</x-app-layout>
