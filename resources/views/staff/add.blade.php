@extends('staff.layout')

@section('content')
    <h2 class="text-center mt-3">Đăng ký nhân viên</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('staff.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Tên:</label>
            <input type="text" class="form-control" name="name" placeholder="Nhập họ và tên" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" placeholder="Nhập email" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label for="phone">Tel:</label>
            <input type="text" class="form-control" name="tel" placeholder="Nhập số điện thoại định dạng xxxx-xxxx-xxxx" value="{{ old('tel') }}">
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        <a href="{{ route('staff.index') }}" class="btn btn-warning mt-3 mb-3">Back</a>
    </form>
@endsection

