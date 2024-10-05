<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\Weeks;
use Illuminate\Http\Request;

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
            $week[] = $dataWeek;
        }
        $data['week'] = $week;
        $data['header_title'] = 'Class Timetable List - ';

        return view('admin.class_timetable.list', $data);
    }

    public function get_subject(Request $request)
    {
        $subjects = ClassSubject::mySubject($request->class_id);
        $html = '<option value="">Select Subject</option>\n';
        foreach ($subjects as $subject) {
            $html .= "<option value='" . $subject->subject_id . "'>" . $subject->subject_name . "</option>\n";
        }
        $json['html'] = $html;
        echo json_encode($json);
    }
}
