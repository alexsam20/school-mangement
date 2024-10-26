<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacher;
use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\Exam;
use App\Models\ExamSchedule;
use App\Models\MarkRegister;
use App\Models\User;
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

    public function schedule(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = Exam::getExam();
        if (!empty($request->get('exam_id')) && !empty($request->get('class_id'))) {
            $subjects = ClassSubject::mySubject($request->get('class_id'));
            $result = [];
            foreach ($subjects as $subject) {
                $data_subject = [];
                $data_subject['subject_id'] = $subject->subject_id;
                $data_subject['class_id'] = $subject->class_id;
                $data_subject['subject_name'] = $subject->subject_name;
                $data_subject['subject_type'] = $subject->subjects_type;
                $examSchedule = ExamSchedule::getRecordSingle($request->get('exam_id'), $request->get('class_id'), $subject->subject_id);
                if (!empty($examSchedule)) {
                    $data_subject['exam_date'] = $examSchedule->exam_date;
                    $data_subject['start_time'] = $examSchedule->start_time;
                    $data_subject['end_time'] = $examSchedule->end_time;
                    $data_subject['room_number'] = $examSchedule->room_number;
                    $data_subject['full_marks'] = $examSchedule->full_marks;
                    $data_subject['passing_marks'] = $examSchedule->passing_marks;
                } else {
                    $data_subject['exam_date'] = '';
                    $data_subject['start_time'] = '';
                    $data_subject['end_time'] = '';
                    $data_subject['room_number'] = '';
                    $data_subject['full_marks'] = '';
                    $data_subject['passing_marks'] = '';
                }
                $result[] = $data_subject;
            }
            $data['getRecords'] = $result;
        }
        $data['header_title'] = 'Exam Schedule - ';
        return view('admin.examinations.exam_schedule', $data);
    }

    public function scheduleInsert(Request $request)
    {
        ExamSchedule::deleteRecord($request->exam_id, $request->class_id);

        if (!empty($request->schedule)) {
            foreach ($request->schedule as $schedule) {
                if (!empty($schedule['subject_id'])
                    && !empty($schedule['exam_date'])
                    && !empty($schedule['start_time'])
                    && !empty($schedule['end_time'])
                    && !empty($schedule['room_number'])
                    && !empty($schedule['full_marks'])
                    && !empty($schedule['passing_marks'])) {
                    $exam = new ExamSchedule();
                    $exam->exam_id = $request->exam_id;
                    $exam->class_id = $request->class_id;
                    $exam->subject_id = $schedule['subject_id'];
                    $exam->exam_date = $schedule['exam_date'];
                    $exam->start_time = $schedule['start_time'];
                    $exam->end_time = $schedule['end_time'];
                    $exam->room_number = $schedule['room_number'];
                    $exam->full_marks = $schedule['full_marks'];
                    $exam->passing_marks = $schedule['passing_marks'];
                    $exam->created_by = Auth::user()->id;
                    $exam->save();
                }

            }

            return redirect()->back()->with('success', 'Exam Schedule successfully saved');
        }
    }

    public function myExamTimetable(Request $request)
    {
        $classId = Auth::user()->class_id;
        $getExams = ExamSchedule::getExam($classId);
        $result = [];
        foreach ($getExams as $exam) {

            $dataExams = [];
            $dataExams['name'] = $exam->exam_name;
            $getExamTimetables = ExamSchedule::getExamTimetable($exam->exam_id, $classId);
            $resultSubjects = [];

            foreach ($getExamTimetables as $examTimetable) {
                $dataExamTable = [];
                $dataExamTable['subject_name'] = $examTimetable->subject_name;
                $dataExamTable['exam_date'] = $examTimetable->exam_date;
                $dataExamTable['start_time'] = $examTimetable->start_time;
                $dataExamTable['end_time'] = $examTimetable->end_time;
                $dataExamTable['room_number'] = $examTimetable->room_number;
                $dataExamTable['full_marks'] = $examTimetable->full_marks;
                $dataExamTable['passing_marks'] = $examTimetable->passing_marks;

                $resultSubjects[] = $dataExamTable;
            }
            $dataExams['exam'] = $resultSubjects;
            $result[] = $dataExams;
        }

        $data['header_title'] = 'My Exam Timetable - ';
        $data['getRecords'] = $result;
        return view('student.my_exam_timetable', $data);
    }

    public function myExamTimetableTeacher()
    {
        $getClass = AssignClassTeacher::getMyClassSubjectGroup(Auth::user()->id);
        $result = [];
        foreach ($getClass as $class) {
            $dataClass = [];
            $dataClass['class_name'] = $class->class_name;
            $getExams = ExamSchedule::getExam($class->class_id);
            $quiz = [];
            foreach ($getExams as $exam) {
                $dataExam = [];
                $dataExam['exam_name'] = $exam->exam_name;
                $getExamTimetables = ExamSchedule::getExamTimetable($exam->exam_id, $class->class_id);
                $resultExamTimetable = [];
                foreach ($getExamTimetables as $examTimetable) {
                    $dataExamTimetable = [];
                    $dataExamTimetable['subject_name'] = $examTimetable->subject_name;
                    $dataExamTimetable['exam_date'] = $examTimetable->exam_date;
                    $dataExamTimetable['start_time'] = $examTimetable->start_time;
                    $dataExamTimetable['end_time'] = $examTimetable->end_time;
                    $dataExamTimetable['room_number'] = $examTimetable->room_number;
                    $dataExamTimetable['full_marks'] = $examTimetable->full_marks;
                    $dataExamTimetable['passing_marks'] = $examTimetable->passing_marks;

                    $resultExamTimetable[] = $dataExamTimetable;
                }
                $dataExam['subject'] = $resultExamTimetable;
                $quiz[] = $dataExam;
            }
            $dataClass['exam'] = $quiz;
            $result[] = $dataClass;
        }

        $data['header_title'] = 'My Exam Timetable - ';
        $data['getRecords'] = $result;
        return view('teacher.my_exam_timetable', $data);
    }

    public function parentMyExamTimetable($student_id)
    {
        $getStudent = User::getSingle($student_id);
        $classId = $getStudent->class_id;
        $getExams = ExamSchedule::getExam($classId);
        $result = [];
        foreach ($getExams as $exam) {

            $dataExams = [];
            $dataExams['name'] = $exam->exam_name;
            $getExamTimetables = ExamSchedule::getExamTimetable($exam->exam_id, $classId);
            $resultSubjects = [];

            foreach ($getExamTimetables as $examTimetable) {
                $dataExamTable = [];
                $dataExamTable['subject_name'] = $examTimetable->subject_name;
                $dataExamTable['exam_date'] = $examTimetable->exam_date;
                $dataExamTable['start_time'] = $examTimetable->start_time;
                $dataExamTable['end_time'] = $examTimetable->end_time;
                $dataExamTable['room_number'] = $examTimetable->room_number;
                $dataExamTable['full_marks'] = $examTimetable->full_marks;
                $dataExamTable['passing_marks'] = $examTimetable->passing_marks;

                $resultSubjects[] = $dataExamTable;
            }
            $dataExams['exam'] = $resultSubjects;
            $result[] = $dataExams;
        }

        $data['header_title'] = 'Exam Timetable - ';
        $data['getRecords'] = $result;
        $data['getStudent'] = $getStudent;
        return view('parent.my_exam_timetable', $data);
    }

    public function marksRegister(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = Exam::getExam();
        if (!empty($request->get('exam_id')) && !empty($request->get('class_id'))) {
            $data['getSubjects'] = ExamSchedule::getSubject($request->get('exam_id'), $request->get('class_id'));
            $data['getStudents'] = User::getStudentClass($request->get('class_id'));
        }
        $data['header_title'] = 'Marks Register - ';
        return view('admin.examinations.marks_register', $data);
    }

    public function marksRegisterTeacher(Request $request)
    {
        $data['getClass'] = AssignClassTeacher::getMyClassSubjectGroup(Auth::user()->id);
        $data['getExam'] = ExamSchedule::getExamTeacher(Auth::user()->id);
        if (!empty($request->get('exam_id')) && !empty($request->get('class_id'))) {
            $data['getSubjects'] = ExamSchedule::getSubject($request->get('exam_id'), $request->get('class_id'));
            $data['getStudents'] = User::getStudentClass($request->get('class_id'));
        }
        $data['header_title'] = 'Marks Register - ';
        return view('teacher.marks_register', $data);
    }

    public function submitMarksRegister(Request $request)
    {
        $validation = 0;
        $marks = $request->marks;
        if (!empty($marks)) {
            foreach ($marks as $mark) {
                $getExamSchedule = ExamSchedule::getSingle($mark['id']);
                $fullMarks = $getExamSchedule->full_marks;

                $class_work = $mark['class_work'] ?: null;
                $home_work = $mark['home_work'] ?: null;
                $test_work = $mark['test_work'] ?: null;
                $exam_work = $mark['exam_work'] ?: null;
                $full_marks = $mark['full_marks'] ?: null;
                $passing_marks = $mark['passing_marks'] ?: null;

                $total_marks = $class_work + $home_work + $test_work + $exam_work;

                if ($fullMarks >= $total_marks) {
                    $getMarks = MarkRegister::CheckAlreadyMark($request->student_id, $request->exam_id, $request->class_id, $mark['subject_id']);
                    if (!empty($getMarks)) {
                        $markRegister = $getMarks;
                    } else {
                        $markRegister = new MarkRegister();
                        $markRegister->created_by = Auth::user()->id;
                    }
                    $markRegister->student_id = $request->student_id;
                    $markRegister->exam_id = $request->exam_id;
                    $markRegister->class_id = $request->class_id;
                    $markRegister->subject_id = $mark['subject_id'];
                    $markRegister->class_work = $class_work;
                    $markRegister->home_work = $home_work;
                    $markRegister->test_work = $test_work;
                    $markRegister->exam_work = $exam_work;
                    $markRegister->full_marks = $full_marks;
                    $markRegister->passing_marks = $passing_marks;
                    $markRegister->save();
                } else {
                    $validation = 1;
                }
            }
        }
        if ($validation == 0) {
            $json['message'] = 'Mark Register successfully saved';
        } else {
            $json['message'] = 'Mark Register successfully saved. Some Subject mark greater then full marks';
        }

        echo json_encode($json);
    }

    public function singleMarksRegister(Request $request)
    {
        $id = $request->id;
        $getExamSchedule = ExamSchedule::getSingle($id);
        $fullMarks = $getExamSchedule->full_marks;

        $class_work = $request->class_work ?: null;
        $home_work = $request->home_work ?: null;
        $test_work = $request->test_work ?: null;
        $exam_work = $request->exam_work ?: null;

        $total_marks = $class_work + $home_work + $test_work + $exam_work;

        if ($fullMarks >= $total_marks) {
            $getMarks = MarkRegister::CheckAlreadyMark($request->student_id, $request->exam_id, $request->class_id,  $request->subject_id);
            if (!empty($getMarks)) {
                $markRegister = $getMarks;
            } else {
                $markRegister = new MarkRegister();
                $markRegister->created_by = Auth::user()->id;
            }
            $markRegister->student_id = $request->student_id;
            $markRegister->exam_id = $request->exam_id;
            $markRegister->class_id = $request->class_id;
            $markRegister->subject_id = $request->subject_id;
            $markRegister->class_work = $class_work;
            $markRegister->home_work = $home_work;
            $markRegister->test_work = $test_work;
            $markRegister->exam_work = $exam_work;
            $markRegister->full_marks = $getExamSchedule->full_marks;
            $markRegister->passing_marks = $getExamSchedule->passing_marks;
            $markRegister->save();

            $json['message'] = 'Mark Register successfully saved';
        } else {
            $json['message'] = 'Your total mark greater then full marks';
        }

        echo json_encode($json);
    }

    public function myExamResult()
    {
        $getExams = MarkRegister::getExam(Auth::user()->id);
        $result = [];
        foreach ($getExams as $exam) {
            $dataExam = [];
            $dataExam['exam_name'] = $exam->exam_name;
            $getExamSubjects = MarkRegister::getExamSubject($exam->exam_id, Auth::user()->id);
            $dataExamSubjects = [];
            foreach ($getExamSubjects as $examSubject) {
                $total_score = $examSubject['class_work'] + $examSubject['test_work'] + $examSubject['home_work'] + $examSubject['exam_work'];
                $dataSubjects = [];
                $dataSubjects['subject_name'] = $examSubject['subject_name'];
                $dataSubjects['class_work'] = $examSubject['class_work'];
                $dataSubjects['test_work'] = $examSubject['test_work'];
                $dataSubjects['home_work'] = $examSubject['home_work'];
                $dataSubjects['exam_work'] = $examSubject['exam_work'];
                $dataSubjects['total_score'] = $total_score;
                $dataSubjects['full_marks'] = $examSubject['full_marks'];
                $dataSubjects['passing_marks'] = $examSubject['passing_marks'];
                $dataExamSubjects[] = $dataSubjects;
            }
            $dataExam['subject'] = $dataExamSubjects;
            $result[] = $dataExam;
        }

        $data['getRecords'] = $result;
        $data['header_title'] = 'My Exam Result - ';
        return view('student.my_exam_result', $data);
    }
}
