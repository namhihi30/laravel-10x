<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStaffRequest;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        if ($keyword){
            $dataStaffs = Staff::all();

            return view('staff.list', compact('dataStaffs'));
        }

        $dataStaffs = Staff::paginate(3);

        return view('staff.list', compact('dataStaffs'));
    }

    public function create()
    {
        return view('staff.add');
    }

    public function store(StoreStaffRequest $request)
    {
        $dataCreateStaff = [
            'name' => htmlspecialchars($request->name),
            'email' => $request->email,
            'tel' => $request->tel,
        ];

        $checkCreateStaff = Staff::create($dataCreateStaff);

        if ($checkCreateStaff) {
            $notification = "Thêm nhân viên thành công !";
        } else {
            $notification = "Thêm nhân viên thất bại !";
        }

        return redirect()->route('staff.index')->with('msg', $notification);
    }

    public function edit($id)
    {
        $staff = Staff::findOrFail($id);

        return view('staff.edit', compact('staff'));
    }

    public function update(StoreStaffRequest $request, $id)
    {
        $dataUpdateStaff = $request->except('_token', '_method');
        $checkUpdateStaff = Staff::findOrFail($id)->update($dataUpdateStaff);
        if ($checkUpdateStaff) {
            $notification = "Sửa nhân viên thành công !";
        } else {
            $notification = "Sửa nhân viên thất bại !";
        }

        return redirect()->route('staff.edit', $id)->with('msg', $notification);
    }

    public function delete($id)
    {
        $staff = Staff::findOrFail($id)->delete();

        if ($staff) {
            $notification = "Xóa nhân viên thành công!";
        }
        else{
            $notification = "Xóa nhân viên thất bại !";
        }

        return redirect()->route('staff.index')->with('msg', $notification);
    }

}
