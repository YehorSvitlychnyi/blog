<x-app-layout>
    <div>
        <form action="{{ route('comment.update', $comment->id) }}" method="post">
            @csrf
            @method('PATCH')
            <label for="comment">Comment</label>
            <input type="text" id="comment" name="name" value="{{ old('name', $comment->name) }}">
            <input type="submit">
        </form>
    </div>
</x-app-layout>
