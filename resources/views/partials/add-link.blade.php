
<div class="card">
    <div class="card-header">
        <h3>Contribute a link</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="/community">
            @csrf

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    placeholder="What is the title of your article?" value="{{ old('title') }}">
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="link">Link:</label>
                <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link"
                    placeholder="What is the URL?" value="{{ old('link') }}">
                @error('link')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group pt-3">
                <button class="btn btn-primary">Contribute!</button>
            </div>

            <div class="form-group">
                <label for="Channel">Channel:</label>
                <select class="form-control @error('channel_id') is-invalid @enderror" name="channel_id">
                <option selected disabled>Pick a Channel...</option>
                @foreach ($channels as $channel)
                <option value="{{ $channel->id }}">
                {{ $channel->title }}
                </option>
                @endforeach
                </select>
                @error('channel_id')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
        </form>
    </div>
</div>




