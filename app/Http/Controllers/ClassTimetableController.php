<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\ClassSubjectTimetable;
use App\Models\Weeks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassTimetableController extends Controller
{
    public function list(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        if (!empty($request->class_id)) {
            $data['getSubject'] = ClassSubject::mySubject($request->class_id);
        }
        $getWeek = Weeks::getRecords();
        $week = [];
        foreach ($getWeek as $day) {
            $dataWeek = [];
            $dataWeek['week_id'] = $day->id;
            $dataWeek['week_name'] = $day->name;
            if (!empty($request->class_id) && !empty($request->subject_id)) {
                $dataWeek[] = $this->timesAndRoomFields($request->class_id, $request->subject_id, $day->id);
            } else {
                $dataWeek[] = $this->emptyTimesAndRoomFields();
            }
            $week[] = $dataWeek;
        }
        $data['week'] = $week;
        $data['header_title'] = 'Class Timetable - ';

        return view('admin.class_timetable.list', $data);
    }

    public function get_subject(Request $request)
    {
        $subjects = ClassSubject::mySubject($request->class_id);
        $html = '<option value="">Select Subject</option>';
        foreach ($subjects as $subject) {
            $html .= "<option value='" . $subject->subject_id . "'>" . $subject->subject_name . "</option>";
        }
        $json['html'] = $html;
        echo json_encode($json);
    }

    public function insert_update(Request $request)
    {
        ClassSubjectTimetable::where('class_id', $request->class_id)->where('subject_id', $request->subject_id)->delete();
        foreach ($request->timetable as $timetable) {
            if (!empty($timetable['week_id']) &&
                !empty($timetable['start_time']) &&
                !empty($timetable['end_time']) &&
                !empty($timetable['room_number'])) {

                $record = new ClassSubjectTimetable();
                $record->class_id = $request->class_id;
                $record->subject_id = $request->subject_id;
                $record->week_id = $timetable['week_id'];
                $record->start_time = $timetable['start_time'];
                $record->end_time = $timetable['end_time'];
                $record->room_number = $timetable['room_number'];
                $record->save();
            }
        }

        return redirect()->back()->with('success', 'Class Timetable Successfully Saved');
    }

    public function myTimetable()
    {
        $result = [];
        $getRecords = ClassSubject::mySubject(Auth::user()->class_id);
        foreach ($getRecords as $value) {
            $dataS['name'] = $value->subject_name;
            $getWeek = Weeks::getRecords();
            $week = [];
            foreach ($getWeek as $day) {
                $dataWeek = [];
                $dataWeek['week_name'] = $day->name;
                $dataWeek[] = $this->timesAndRoomFields($value->class_id, $value->subject_id, $day->id);
                $week[] = $dataWeek;
            }
            $dataS['week'] = $week;
            $result[] = $dataS;
        }
        $data['getRecords'] = $result;
        $data['header_title'] = 'My Timetable - ';

        return view('student.my_timetable', $data);
    }

    private function timesAndRoomFields($class, $subject, $weekDay)
    {
        $classSubject = ClassSubjectTimetable::getRecordClassSubject($class, $subject, $weekDay);
        $dataWeek = [];
        if (!empty($classSubject)) {
            $dataWeek['start_time'] = $classSubject->start_time;
            $dataWeek['end_time'] = $classSubject->end_time;
            $dataWeek['room_number'] = $classSubject->room_number;
        } else {
            $dataWeek['start_time'] = '';
            $dataWeek['end_time'] = '';
            $dataWeek['room_number'] = '';
        }

        return $dataWeek;
    }

    private function emptyTimesAndRoomFields()
    {
        $dataWeek = [];

        $dataWeek['start_time'] = '';
        $dataWeek['end_time'] = '';
        $dataWeek['room_number'] = 'Jopa';

        dd($dataWeek);

        return $dataWeek;
    }
}
