<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function list()
    {
        $data['getRecords'] = Exam::getRecords();
        $data['header_title'] = 'Exam List - ';
        return view('admin.examinations.exam.list', $data);
    }
    public function add()
    {
        $data['header_title'] = 'Add New Exam - ';
        return view('admin.examinations.exam.add', $data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'note' => 'max:255',
        ]);

        $exam = new Exam();
        $exam->name = trim($request->name);
        $exam->note = trim($request->note);
        $exam->created_by = Auth::user()->id;
        $exam->save();

        return redirect('admin/examinations/exam/list')->with('success', 'Exam successfully created');
    }

    public function edit($id)
    {
        $data['getExam'] = Exam::getSingle($id);
        if (!empty($data['getExam'])) {
            $data['header_title'] = 'Edit Exam - ';
            return view('admin.examinations.exam.edit', $data);
        } else {
            abort(404);
        }

    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'note' => 'max:255',
        ]);

        $exam = Exam::getSingle($id);
        $exam->name = trim($request->name);
        $exam->note = trim($request->note);
        $exam->save();

        return redirect('admin/examinations/exam/list')->with('success', 'Exam successfully updated');
    }

    public function delete($id)
    {
        $exam = Exam::getSingle($id);
        if (!empty($exam)) {
            $exam->is_deleted = date('Y-m-d H:i:s');
            $exam->save();
            return redirect()->back()->with('success', 'Exam successfully deleted');
        } else {
            abort(404);
        }
    }
}
