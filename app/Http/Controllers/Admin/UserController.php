<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $dataUser = User::all();
        return view('admin.users.list', compact('dataUser'));
    }

    public function add()
    {
        $dataGroup = Group::all();
        return view('admin.users.add', compact('dataGroup'));
    }

    public function postAdd(UserRequest $request)
    {
        $dataInsert = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'group_id' => $request->group,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        User::create($dataInsert);
        return redirect()->route('admin.users.index')->with('msg', 'Thêm người dùng thành công');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $this->authorize('update', $user);
        $userDetails = User::find($id);
        $dataGroup = Group::all();
        if (!empty($userDetails)) {
            session()->put('id', $id);
        }
        return view('admin.users.edit', compact('userDetails', 'dataGroup'));
    }

    public function postEdit(Request $request)
    {
        $id = session('id');
        $user = User::find($id);
        if ($user) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'group_id' => $request->group,
                'created_at' => now(),
            ]);
            return redirect()->route('admin.users.edit', ['id' => $id])->with('msg', 'Cập nhật người dùng thành công');
        } else {
            // Xử lý trường hợp không tìm thấy người dùng
            return redirect()->route('admin.users.index')->with('msg', 'Người dùng không tồn tại');
        }
    }

    public function delete($id)
    {
        User::find($id)->delete();
        return redirect()->route('admin.users.index')->with('msg', 'Xóa người dùng thành công');
    }
}
