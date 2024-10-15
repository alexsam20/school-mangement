<?php

namespace App\Http\Controllers;

use App\Models\ClassSubject;
use App\Models\Weeks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function myCalendar()
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
                $dataWeek['fullcalendar_day'] = $day->fullcalendar_day;
                $times = ClassTimetableController::timesAndRoomFields($value->class_id, $value->subject_id, $day->id);
                if (empty($times['start_time']))
                    continue;
                $week[] = array_merge($dataWeek, $times);
            }
            $dataS['week'] = $week;
            if (empty($dataS['week']))
                continue;
            $result[] = $dataS;
        }

        $data['getRecordsTimeTbl'] = $result;
        $data['header_title'] = 'My Calendar - ';

        return view('student.my_calendar', $data);
    }
}
