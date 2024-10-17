<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacher;
use App\Models\ClassSubject;
use App\Models\ExamSchedule;
use App\Models\User;
use App\Models\Weeks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    // timetable
    public function myCalendar()
    {
        $class_id = Auth::user()->class_id;
        $data['getRecordsTimeTbl'] = $this->getTimetable($class_id);
        $data['getRecordsExamTimeTbl'] = $this->getExamTimetable($class_id);
        $data['header_title'] = 'My Calendar - ';

        return view('student.my_calendar', $data);
    }

    public function getExamTimetable($classId)
    {
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

        return $result;
    }

    public function getTimetable($class_id)
    {
        $result = [];
        $getRecords = ClassSubject::mySubject($class_id);
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
            $result[] = $dataS;
        }

        return $result;
    }

    public function myCalendarParent($student_id)
    {
        $getStudent = User::getSingle($student_id);
        $data['getRecordsTimeTbl'] = $this->getTimetable($getStudent->class_id);
        $data['getRecordsExamTimeTbl'] = $this->getExamTimetable($getStudent->class_id);
        $data['getStudent'] = $getStudent;
        $data['header_title'] = 'Student Calendar - ';

        return view('parent.my_calendar', $data);
    }

    public function myCalendarTeacher()
    {
        $teacher_id = Auth::user()->id;
        $data['getClassTimetable'] = AssignClassTeacher::getCalendarTeacher($teacher_id);

        $data['header_title'] = 'My Calendar - ';

        return view('teacher.my_calendar', $data);
    }
}
