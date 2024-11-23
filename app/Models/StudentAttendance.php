<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
