@extends('staff.layout')

@section('content')
    <h2 class="text-center mt-3">Danh sách nhân viên</h2>

      <a href="{{ route('staff.create') }}" class="btn btn-primary mt-3 mb-3">Tạo mới nhân viên</a>
      <a href="{{ route('logout') }}" class="btn btn-danger mt-3 mb-3 ">Logout</a>


    <form action="{{ route('staff.index') }}">
        <div class="input-group mb-3 col-5">
            <input type="text" name="keyword" class="form-control" placeholder="Nhập tên nhân viên...">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Tìm kiếm</button>
            </div>
        </div>
    </form>

    @if(session('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Tel</th>
            <th>Sửa</th>
        </tr>
        </thead>
        <tbody>
        @foreach($dataStaffs as $staff)
        <tr>
            <td>{{ $staff->id }}</td>
            <td>{{ $staff->name }}</td>
            <td>{{ $staff->email }}</td>
            <td>{{ $staff->tel }}</td>
            <td>
                <a href="{{ route('staff.edit',$staff->id) }}" class="btn btn-warning">Sửa</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>


    <div class="d-flex">
        {!! $dataStaffs->onEachSide(1)->links('staff.pagination_custom', ['paginator' => $dataStaffs]) !!}
    </div>

@endsection

