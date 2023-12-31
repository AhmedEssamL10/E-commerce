@extends('admin.layouts.admin')
@section('title', 'Update News')
@section('contant')
    @include('admin.layouts.messages')
    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.news.update', $news->id) }}">
        @csrf
        <div class="col">
            <div iv class="col-md-6">
                <div class="mb-3">
                    <input type="text" name="title" class="form-control" placeholder="Title"
                        value="{{ $news->title ?? old('title') }}">
                </div>
            </div>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="desc">Description</label>
                    <textarea name="desc" id="desc" cols="50" rows="5">{{ $news->desc ?? old('desc') }}</textarea>
                </div>
            </div>
            @error('desc')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <img src="{{ asset('images/news/' . $news->image) }}" style="width: 20%" alt="">
            <input class="form-control" type="file" id="formFile" name="image"
                value="{{ old('image') ?? $news->image }}">
        </div>
        @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
