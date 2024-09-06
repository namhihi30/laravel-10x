@extends('layouts.admin')

@section('title', 'Cập nhật người dùng')

@section('content')
    <h1>Cập nhật Người Dùng Mới</h1>
    <div class="container mt-4">
        @if(session('msg'))
            <div class="alert alert-success" role="alert">{{ session('msg') }}</div>
        @endif
    </div>
    @if($errors->any())
        <div class="alert alert-danger" role="alert">Vui lòng kiểm tra lại</div>
    @endif
    <form action=" {{ route('admin.groups.post_edit') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name')?? $groupDetails->name  }} ">
            @error('name')
            <p style="color: red">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a class="btn btn-dark" href="{{ route('admin.users.index') }}">Quay lại</a>
        </div>
    </form>
@endsection

