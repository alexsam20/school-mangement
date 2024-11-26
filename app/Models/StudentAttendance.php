<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class StudentAttendance extends Model
{
    use HasFactory;

    protected $table = 'student_attendances';

    public static function CheckAttendance($student_id, $class_id, $attendance_date)
    {
        return self::where('student_id', $student_id)
            ->where('class_id', $class_id)
            ->where('attendance_date', $attendance_date)
            ->first();
    }

    public static function getRecords()
    {
        $records = self::select('student_attendances.*', 'class.name as class_name', 'student.name as student_name', 'student.last_name as student_last_name', 'creator.name as creator_name')
            ->join('class', 'class.id', 'student_attendances.class_id')
            ->join('users as student', 'student.id', 'student_attendances.student_id')
            ->join('users as creator', 'creator.id', 'student_attendances.created_by');
        if (!empty(Request::get('student_id'))) {
            $records = $records->where('student_attendances.student_id', Request::get('student_id'));
        }
        $student_name = Request::get('student_name');
        if (!empty($student_name)) {
            $records = $records->where(function ($query) use ($student_name) {
                $query->where('student.name', 'like', '%' . $student_name . '%')
                    ->orWhere('student.last_name', 'like', '%' . $student_name . '%');
            });
//            $records = $records->where('student.name', 'like', '%' . $student_name . '%');
        }
        if (!empty(Request::get('class_id'))) {
            $records = $records->where('student_attendances.class_id', Request::get('class_id'));
        }
        if (!empty(Request::get('attendance_date'))) {
            $records = $records->where('student_attendances.attendance_date', Request::get('attendance_date'));
        }
        if (!empty(Request::get('attendance_type'))) {
            $records = $records->where('student_attendances.attendance_type', Request::get('attendance_type'));
        }
        $records = $records->orderBy('student_attendances.id', 'desc')
            ->paginate(50);

        return $records;
    }
}
