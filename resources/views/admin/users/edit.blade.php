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
    <form action=" {{ route('admin.users.post_edit') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name')?? $userDetails->name  }} ">
            @error('name')
            <p style="color: red">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') ?? $userDetails->email }}">
            @error('email')
            <p style="color: red">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="group" class="form-label">Nhóm:</label>
            <select class="form-select" id="group" name="group" >
                <option value="0">Vui lòng chọn</option>
                @foreach($dataGroup as $group)
                    <option value="{{ $group->id }}" {{ old('group') || $userDetails->group_id == $group->id ? 'selected': false }}>{{ $group->name }}</option>
                @endforeach
            </select>
            @error('group')
            <p style="color: red">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a class="btn btn-dark" href="{{ route('admin.users.index') }}">Quay lại</a>
        </div>
    </form>
@endsection

