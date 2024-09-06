@extends('layouts.admin')

@section('title', 'Thêm nhóm người dùng')

@section('content')
<h1>Thêm nhóm người dùng</h1>
@if($errors->any())
    <div class="alert alert-danger" role="alert">Vui lòng kiểm tra lại</div>
@endif
<form action=" {{ route('admin.groups.add') }}" method="post">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Tên:</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
        @error('name')
        <p style="color: red">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Thêm Mới</button>
        <a class="btn btn-dark" href="">Quay lại</a>
    </div>
</form>
@endsection
