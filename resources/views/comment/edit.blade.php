<x-app-layout>
    <div class="form-container">
        <form action="{{ route('comment.update', $comment->id) }}" method="post" class="form-box">
            @csrf
            @method('PATCH')
            <label for="comment" class="form-label">Comment</label>
            <input type="text" id="comment" name="name" value="{{ old('name', $comment->name) }}" class="form-comment-input">
            <input type="submit" class="submit-button">
        </form>
    </div>
</x-app-layout>
