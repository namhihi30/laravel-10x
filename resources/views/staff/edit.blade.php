@extends('staff.layout')

@section('content')
    <h2 class="text-center mt-3">Sửa nhân viên</h2>

    @if(session('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('staff.update',$staff->id) }}" method="POST">
        @csrf
        @method("PUT")
        <div class="form-group">
            <label for="name">Họ và tên:</label>
            <input type="text" class="form-control" name="name" placeholder="Nhập họ và tên"
                   value="{{ old('name') ?? $staff->name  }}">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" placeholder="Nhập email"
                   value="{{ old('email') ?? $staff->email  }}">
        </div>
        <div class="form-group">
            <label for="phone">Số điện thoại:</label>
            <input type="text" class="form-control" name="tel" placeholder="Nhập số điện thoại"
                   value="{{ old('tel') ?? $staff->tel  }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('staff.index') }}" class="btn btn-warning mt-3 mb-3">Back</a>
    </form>
    <form action="{{ route('staff.delete',$staff->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Bạn có muốn xóa thông tin của {{ $staff->name ?? "người dùng này" }} không ?')" class="btn btn-danger">Delete</button>
    </form>
@endsection


