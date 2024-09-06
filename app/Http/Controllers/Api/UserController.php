<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = User::all();
        if ($user->count() > 0) {
            $status = "Success";
        } else {
            $status = "Error";
        }
        $user->load('posts');
        return new UserCollection($user, $status);
    }

    public function detail($id)
    {
        $user = User::with('posts')->find($id);
        if ($user) {
            $statusCode = 200;
        } else {
            $statusCode = 204;
        }
        $user = new UserResource($user,$statusCode);
//        $response = [
//            'statusCode' => $statusCode,
//            'data' => 'no data available',
//        ];
        return $user;
    }

    public function create(Request $request)
    {
        $rule = [
            'name' => 'required|min:3',
            'password' => 'required|min:3',
            'email' => 'required|email|'
        ];

        $message = [
            'name.required' => 'Không được bỏ trống trường tên',
            'password.required' => 'Không được bỏ trống trường mật khẩu',
            'name.min' => 'Nhập lớn hơn 3 ký tự nha',
            'password.min' => 'Nhập lớn hơn 3 ký tự nha',
            'email.required' => 'Không được bỏ trống trường mail',
            'email.email' => 'Không đúng định dạng',
            'email.unique' => 'Email đã tồn tại ',
            'group.required' => 'Không được bỏ trống nhóm',
        ];
        $request->validate($rule, $message);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->group_id = 3;
        $user->save();
        if ($user->id) {
            $response = [
                'status' => 'success',
                'data' => $user,
            ];
        } else {
            $response = [
                'status' => 'error',
            ];
        }
        return $response;
    }

    public function update(Request $request)
    {
        return $request->all();
    }

    public function delete($id)
    {
        return $id;
    }
}
