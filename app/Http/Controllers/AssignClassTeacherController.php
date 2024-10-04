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

    public function edit($id)
    {
        $getRecord = AssignClassTeacher::getSingle($id);
        if (!empty($getRecord)) {
            $data['getRecord'] = $getRecord;
            $data['getAssignTeacherID'] = AssignClassTeacher::getAssignTeacherID($getRecord->class_id);
            $data['getClass'] = ClassModel::getClass();
            $data['getTeacher'] = User::getTeacherClass();
            $data['header_title'] = 'Edit Assign Class Teacher - ';

            return view('admin.assign_class_teacher.edit', $data);
        } else {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        AssignClassTeacher::deleteTeacher($request->class_id);

        if (!empty($request->teacher_id)) {
            foreach ($request->teacher_id as $teacher) {
                $getAlreadyFirst = AssignClassTeacher::getAlreadyFirst($request->class_id, $teacher);
                if (!empty($getAlreadyFirst)) {
                    $getAlreadyFirst->status = (int)$request->status;
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
        }

        return redirect('admin/assign_class_teacher/list')->with('success', 'Assign Class to Teacher Successfully');
    }

    public function edit_single($id)
    {
        $getRecord = AssignClassTeacher::getSingle($id);
        if (!empty($getRecord)) {
            $data['getRecord'] = $getRecord;
            $data['getClass'] = ClassModel::getClass();
            $data['getTeacher'] = User::getTeacherClass();
            $data['header_title'] = 'Edit Assign Class Teacher - ';

            return view('admin.assign_class_teacher.edit_single', $data);
        } else {
            abort(404);
        }
    }

    public function update_single($id, Request $request)
    {
        $getAlreadyFirst = AssignClassTeacher::getAlreadyFirst($request->class_id, $request->teacher_id);
        if (!empty($getAlreadyFirst)) {
            $getAlreadyFirst->status = $request->status;
            $getAlreadyFirst->save();

            return redirect('admin/assign_class_teacher/list')->with('success', 'Status Successfully Updated');
        } else {
            $record = AssignClassTeacher::getSingle($id);
            $record->class_id = $request->class_id;
            $record->teacher_id = $request->teacher_id;
            $record->status = $request->status;
            $record->save();

            return redirect('admin/assign_class_teacher/list')->with('success', 'Assign Class to Teacher Successfully Updated');
        }
    }

    public function delete($id)
    {
        $delete = AssignClassTeacher::getSingle($id);
        $delete->delete();

        return redirect()->back()->with('success', 'Record deleted');
    }

    public function myClassSubject()
    {
        $data['getRecords'] = AssignClassTeacher::getMyClassSubject(Auth::user()->id);
        $data['header_title'] = 'My Class & Subject - ';
        return view('teacher.my_class_subject', $data);
    }
}
