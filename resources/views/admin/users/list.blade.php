@extends('layouts.admin')

@section('title', 'Danh sách người dùng')

@section('content')
    <div class="container mt-4">
        @if(session('msg'))
            <div class="alert alert-success" role="alert">{{ session('msg') }}</div>
        @endif
    </div>
    <h1>Danh sách người dùng</h1>
    @can('create',\App\Models\User::class)
        <div class="mb-5 mt-5">
            <a href="{{ route('admin.users.add') }}" class="btn btn-primary">Thêm mới</a>
        </div>
    @endcan
    <table class="table">
        <thead>
        <tr>
            <th>STT</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Nhóm</th>
            <th>Ngày Tạo</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($dataUser))
            @foreach ($dataUser as $key => $user)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->group_id }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        @can('users.edit',\App\Models\User::class)
                            <a href="{{ route('admin.users.edit',['id' => $user->id]) }}"
                               class="btn btn-warning">Sửa</a>
                        @endcan
                         @can('users.delete',\App\Models\User::class)
                        <a onclick="return confirm('Bạn có muốn xóa không ?')"
                           href="{{ route('admin.users.delete',['id' => $user->id]) }}" class="btn btn-danger">Xóa</a>
                         @endcan
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5">Không có người dùng nào.</td>
            </tr>
        @endif
        </tbody>
    </table>
@endsection
