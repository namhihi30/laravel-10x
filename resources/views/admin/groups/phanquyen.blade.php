@extends('layouts.admin')

@section('title', 'Phân quyền nhóm')

@section('content')
    <h1>Phân quyền nhóm: {{ $data->name}}</h1>
    @if($errors->any())
        <div class="alert alert-danger" role="alert">Vui lòng kiểm tra lại</div>
    @endif
    <form action="" method="post">
        <table class="table">
            <thead>
            <tr>
                <th>Module</th>
                <th>Quyền</th>
            </tr>
            </thead>
            <tbody>
            @if(!empty($dataModule))
                @foreach ($dataModule as $user)
                    <tr>
                        <td>{{ $user->title }}</td>
                        <td>
                            <div class="row">
                                @if(!empty($roleArray))
                                    @foreach ($roleArray as $roleName => $roleLabel)
                                        <label for="role_{{ $user->name }}_{{ $roleName }}">
                                            <input type="checkbox" name="role[{{$user->name}}][]"
                                                   id="role_{{ $user->name }}_{{ $roleName }}"
                                                   value="{{$roleName}}"  {{ isRole($roleArrayData,$user->name,$roleName) ? 'checked': false }}>{{$roleLabel}}

                                            <input type="hidden" name="name" value="{{ $data->name}}">
                                        </label>
                                    @endforeach
                                @endif
                            </div>
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
        <button type="submit" class="btn btn-primary">Phân quyền</button>
        @csrf
    </form>
@endsection
