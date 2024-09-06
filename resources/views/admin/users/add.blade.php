@extends('layouts.admin')

@section('title', 'Thêm người dùng')

@section('content')
<h1>Thêm người dùng</h1>
@if($errors->any())
    <div class="alert alert-danger" role="alert">Vui lòng kiểm tra lại</div>
@endif
<form action=" {{ route('admin.users.add') }}" method="post">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Tên:</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
        @error('name')
        <p style="color: red">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
        @error('email')
        <p style="color: red">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mật khẩu:</label>
        <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
        @error('password')
        <p style="color: red">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="group" class="form-label">Chọn nhóm:</label>
        <select class="form-select" id="group" name="group" >
            <option value="0">Vui lòng chọn</option>
            @foreach($dataGroup as $group)
                <option value="{{ $group->id }}" {{ old('group') == $group->id ? 'selected': false }}>{{ $group->name }}</option>
            @endforeach
        </select>
        @error('group')
        <p style="color: red">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Thêm Mới</button>
        <a class="btn btn-dark" href="">Quay lại</a>
    </div>
</form>
@endsection
