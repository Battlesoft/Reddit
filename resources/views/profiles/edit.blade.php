@extends('layouts.app')
@section('content')
    <form action="/profile/store" method="POST" id="updateImage" enctype="multipart/form-data">
        @csrf
        @error('imageUpload')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="imageUpload">Image Upload:</label>
        <input type="file" name="imageUpload" class="form-control @error('imageUpload') is-invalid @enderror"
            id="imageUpload" placeholder="Select an image" value="{{ old('imageUpload') }}">

        <button type="submit">Upload Image</button>

    </form>
@stop
