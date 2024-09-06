@extends('layouts.admin')

@section('title', 'Danh sách nhóm người dùng')

@section('content')
    <div class="container mt-4">
        @if(session('msg'))
            <div class="alert alert-success" role="alert">{{ session('msg') }}</div>
        @endif
    </div>
    <h1>Danh sách nhóm người dùng</h1>
    @can('create', \App\Models\Group::class)
        <div class="mb-5 mt-5">
            <a href="{{ route('admin.groups.add') }}" class="btn btn-primary">Thêm mới</a>
        </div>
    @endcan
    <table class="table">
        <thead>
        <tr>
            <th>STT</th>
            <th>Tên</th>
            <th>Người đăng</th>
            <th>Phân quyền</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($dataGroup))
            @foreach ($dataGroup as $key => $user)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->postBy->name }}</td>
                    <td>
                        <a href="{{ route('admin.groups.phanquyen',$user) }}" class="btn btn-primary">Phân quyền</a>

                    </td>
                    <td>
                        <a href="{{ route('admin.groups.edit',['id' => $user->id]) }}" class="btn btn-warning">Sửa</a>
                        <a onclick="return confirm('Bạn có muốn xóa không ?')"
                           href="{{ route('admin.groups.delete',['id' => $user->id]) }}" class="btn btn-danger">Xóa</a>
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
