<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\StudentAttendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function attendanceStudent(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        if (!empty($request->get('class_id')) && !empty($request->get('attendance_date'))) {
            $data['getStudent'] = $data['getStudents'] = User::getStudentClass($request->get('class_id'));
        }

        $data['header_title'] = 'Attendance Student - ';

        return view('admin.attendance.student', $data);
    }

    public function attendanceStudentSubmit(Request $request)
    {
        $check_attendance = StudentAttendance::CheckAttendance($request->student_id, $request->class_id, $request->attendance_date);
        if (!empty($check_attendance)){
            $attendance = $check_attendance;
        } else {
            $attendance = new StudentAttendance();
            $attendance->student_id = $request->student_id;
            $attendance->class_id = $request->class_id;
            $attendance->attendance_date = $request->attendance_date;
            $attendance->created_by = Auth::user()->id;
        }
        $attendance->attendance_type = $request->attendance_type;
        $attendance->save();

        $json['message'] = 'Attendance Successfully Saved';
        echo json_encode($json);
    }

    public function attendanceReport(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getRecords'] = StudentAttendance::getRecords();
        $data['header_title'] = 'Attendance Report - ';

        return view('admin.attendance.report', $data);
    }
}