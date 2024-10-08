<?php

namespace App\Http\Controllers;

use App\Models\ClassSubject;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function list()
    {
        $data['getRecords'] = Subject::getRecords();
        $data['header_title'] = 'Subject List - ';

        return view('admin.subject.list', $data);
    }

    public function add()
    {
        $data['header_title'] = 'Add New Subject - ';
        return view('admin.subject.add', $data);
    }

    public function insert(Request $request)
    {
        $subject = new Subject();
        $subject->name = trim($request->name);
        $subject->type = $request->type;
        $subject->status = $request->status;
        $subject->created_by = Auth::user()->id;
        $subject->save();

        return redirect('admin/subject/list')->with('success', 'Subject successfully created');
    }

    public function edit($id)
    {
        $data['getRecord'] = Subject::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = 'Edit Subject - ';
            return view('admin.subject.edit', $data);
        } else {
            abort(404);
        }

    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $subject = Subject::getSingle($id);
        $subject->name = trim($request->name);
        $subject->type = $request->type;
        $subject->status = $request->status;
        $subject->save();

        return redirect('admin/subject/list')->with('success', 'Subject successfully updated');
    }

    public function delete($id)
    {
        $subject = Subject::getSingle($id);
        $subject->is_delete = 1;
        $subject->save();

        return redirect()->back()->with('success', 'Subject deleted');
    }

    public function mySubject()
    {
        $data['getRecords'] = ClassSubject::mySubject(Auth::user()->class_id);
        $data['header_title'] = 'My Subject - ';

        return view('student.my_subject', $data);
    }

    public function parentStudentSubject($student_id)
    {
        $student = User::getSingle($student_id);
        $data['getUser'] = $student;
        $data['getRecords'] = ClassSubject::mySubject($student->class_id);
        $data['header_title'] = 'Student Subject - ';

        return view('parent.my_student_subject', $data);
    }
}
