<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Group;
use App\Models\Module;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index(User $user, Group $group)
    {
//        $userId = auth()->user()->id;
//        $dataGroup = Group::where('user_id', $userId)->get();
        $dataGroup = Group::all();
        return view('admin.groups.list', compact('dataGroup'));
    }

    public function add()
    {
        return view('admin.groups.add');
    }

    public function postAdd(Request $request)
    {
        $dataInsert = [
            'name' => $request->name,
            'user_id' => Auth::user()->id,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        Group::create($dataInsert);
        return redirect()->route('admin.groups.index')->with('msg', 'Thêm người dùng thành công');
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Group $group,$id)
    {
        $groupDetails = Group::find($id);
        $this->authorize('update', $groupDetails);
        if (!empty($groupDetails)) {
            session()->put('id', $id);
        }
        return view('admin.groups.edit', compact('groupDetails'));
    }

    public function postEdit(Request $request)
    {
        $id = session('id');
        $group = Group::find($id);
        if ($group) {
            $group->update([
                'name' => $request->name,
            ]);
            return redirect()->route('admin.groups.edit', ['id' => $id])->with('msg', 'Cập nhật người dùng thành công');
        } else {
            return redirect()->route('admin.groups.index')->with('msg', 'Người dùng không tồn tại');
        }
    }

    public function delete($id)
    {
        Group::find($id)->delete();
        return redirect()->route('admin.groups.index')->with('msg', 'Xóa người dùng thành công');
    }

    public function phanquyen(User $user, Group $group, $id)
    {
        $data = Group::find($id);
        $dataModule = Module::all();
        $roleArray = [
            'view' => 'Xem',
            'add' => 'Thêm',
            'edit' => 'Sửa',
            'delete' => 'Xóa',
        ];
        $roleJson = $group->find($id)->phanquyen;
        if (!empty($roleJson)) {
            $roleArrayData = json_decode($roleJson, true);
        } else {
            $roleArrayData = [];
        }
        return view('admin.groups.phanquyen', compact(
            'data',
            'dataModule',
            'roleArray',
            'roleArrayData'
        ));
    }

    public function postPhanquyen(Group $group, Request $request)
    {
        if (!empty($request->role)) {
            $roleArray = $request->role;
        } else {
            $roleArray = [];
        }
        $roleJson = json_encode($roleArray);
        $group->where('id', $request->id)->update([
            'phanquyen' => $roleJson,
        ]);
        return back();
    }
}
