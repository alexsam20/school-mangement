<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassSubjectController extends Controller
{
    public function list()
    {
        $data['getRecords'] = ClassSubject::getRecords();
        $data['header_title'] = 'Assign Subject List - ';

        return view('admin.assign_subject.list', $data);
    }

    public function add()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = Subject::getSubject();
        $data['header_title'] = 'Add Assign Subject - ';

        return view('admin.assign_subject.add', $data);
    }

    public function insert(Request $request)
    {
        if (!empty($request->subject_id && is_numeric($request->class_id))) {
            foreach ($request->subject_id as $subject_id) {
                $getAlreadyFirst = ClassSubject::getAlreadyFirst($request->class_id, $subject_id);
                if (!empty($getAlreadyFirst)) {
                    $getAlreadyFirst->status = $request->staus;
                    $getAlreadyFirst->save();
                } else {
                    $cls_sbj = new ClassSubject();
                    $cls_sbj->class_id = $request->class_id;
                    $cls_sbj->subject_id = $subject_id;
                    $cls_sbj->status = $request->status;
                    $cls_sbj->created_by = Auth::user()->id;
                    $cls_sbj->save();
                }
            }

            return redirect('admin/assign_subject/list')->with('success', 'Subject Successfully Assign to Class');
        } else {
            return redirect()->back()->with('error', 'Due to some error pls try again.');
        }
    }

    public function edit($id)
    {
        $getRecord = ClassSubject::getSingle($id);
        if (!empty($getRecord)) {
            $data['getRecord'] = $getRecord;
            $data['getAssignSubjectID'] = ClassSubject::getAssignSubjectID($getRecord->class_id);
            ClassSubject::getAssignSubjectID($getRecord->class_id);
            $data['getClass'] = ClassModel::getClass();
            $data['getSubject'] = Subject::getSubject();
            $data['header_title'] = 'Edit Assign Subject - ';

            return view('admin.assign_subject.edit', $data);
        } else {
            abort(404);
        }

    }

    public function update(Request $request)
    {
        ClassSubject::deleteSubject($request->class_id);

        if (!empty($request->subject_id && is_numeric($request->class_id))) {
            foreach ($request->subject_id as $subject_id) {
                $getAlreadyFirst = ClassSubject::getAlreadyFirst($request->class_id, $subject_id);
                if (!empty($getAlreadyFirst)) {
                    $getAlreadyFirst->status = $request->staus;
                    $getAlreadyFirst->save();
                } else {
                    $cls_sbj = new ClassSubject();
                    $cls_sbj->class_id = $request->class_id;
                    $cls_sbj->subject_id = $subject_id;
                    $cls_sbj->status = $request->status;
                    $cls_sbj->created_by = Auth::user()->id;
                    $cls_sbj->save();
                }
            }
        }
        return redirect('admin/assign_subject/list')->with('success', 'Subject Successfully Assign to Class');
    }

    public function delete($id)
    {
        $cls_sbj = ClassSubject::getSingle($id);
        $cls_sbj->is_delete = 1;
        $cls_sbj->save();

        return redirect()->back()->with('success', 'Record deleted');
    }
}

