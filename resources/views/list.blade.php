<form method="POST" action="/votes/{{ $link->id }}">
    {{ csrf_field() }}
    <button type="button" class="btn btn-secondary" {{ Auth::guest() ? 'disabled' : '' }}>
        {{ $link->users()->count() }}
    </button>
</form>

