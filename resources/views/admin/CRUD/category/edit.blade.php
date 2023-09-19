@extends('admin.layouts.admin')
@section('title', 'Categories')
@section('contant')
    @include('admin.layouts.messages')
    <form method="POST" enctype="multipart/form-data" action="{{ route('catigories.update', $catigories->id) }}">
        @csrf
        <div class="row">
            <div iv class="col-md-6">
                <div class="mb-3">
                    <input type="text" name="en_name" class="form-control" placeholder="En Name"
                        value="{{ $catigories->en_name ?? old('en_name') }}">
                </div>
            </div>
            @error('en_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="col-md-6">
                <div class="mb-3">
                    <input type="text" name="ar_name" class="form-control" placeholder="Ar Name"
                        value="{{ $catigories->ar_name ?? old('ar_name') }}">
                </div>
            </div>
            @error('ar_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option @selected($catigories->status == 1) value="1">Active</option>
                        <option @selected($catigories->status == 0) value="0">Not Active</option>

                    </select>
                </div>
            </div>
            @error('status')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary">Update</button>
    </form>

@endsection
