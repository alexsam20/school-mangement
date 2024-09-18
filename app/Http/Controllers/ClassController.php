<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function list()
    {
        $data['getRecords'] = ClassModel::getRecords();
        $data['header_title'] = 'Class List - ';
        return view('admin.class.list', $data);
    }

    public function add()
    {
        $data['header_title'] = 'Add New Class - ';
        return view('admin.class.add', $data);
    }

    public function insert(Request $request)
    {
        $class = new ClassModel();
        $class->name = $request->name;
        $class->status = $request->status;
        $class->created_by = Auth::user()->id;
        $class->save();

        return redirect('admin/class/list')->with('success', 'Class successfully created');
    }

    public function edit($id)
    {
        $data['getRecord'] = ClassModel::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = 'Edit Class - ';
            return view('admin.class.edit', $data);
        } else {
            abort(404);
        }

    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $class = ClassModel::getSingle($id);
        $class->name = trim($request->name);
        $class->status = $request->status;
        $class->save();

        return redirect('admin/class/list')->with('success', 'Class successfully updated');
    }

    public function delete($id)
    {
        $user = ClassModel::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect()->back()->with('success', 'Class deleted');
    }
}
