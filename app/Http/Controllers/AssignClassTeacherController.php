<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacher;
use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignClassTeacherController extends Controller
{
    public function list()
    {
        $data['getRecords'] = AssignClassTeacher::getRecords();
        $data['header_title'] = 'Assign Class Teacher - ';

        return view('admin.assign_class_teacher.list', $data);
    }

    public function add()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getTeacher'] = User::getTeacherClass();
        $data['header_title'] = 'Add Assign Class Teacher - ';

        return view('admin.assign_class_teacher.add', $data);
    }

    public function insert(Request $request)
    {
        if (!empty($request->teacher_id)) {
            foreach ($request->teacher_id as $teacher) {
                $getAlreadyFirst = AssignClassTeacher::getAlreadyFirst($request->class_id, $teacher);
                if (!empty($getAlreadyFirst)) {
                    $getAlreadyFirst->status = (int)$request->staus;
                    $getAlreadyFirst->save();
                } else {
                    $record = new AssignClassTeacher();
                    $record->class_id = $request->class_id;
                    $record->teacher_id = $teacher;
                    $record->status = (int)$request->status;
                    $record->created_by = Auth::user()->id;
                    $record->save();
                }
            }

            return redirect('admin/assign_class_teacher/list')->with('success', 'Assign Class to Teacher Successfully');
        } else {
            return redirect()->back()->with('error', 'Due to some error pls try again.');
        }
    }
}
