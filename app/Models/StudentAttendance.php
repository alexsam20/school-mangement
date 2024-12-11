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
        if (self::isNotEmptyGet('student_id')) {
            $records = $records->where('student_attendances.student_id', Request::get('student_id'));
        }
        $student_name = Request::get('student_name');
        if (!empty($student_name)) {
            $records = $records->where(function ($query) use ($student_name) {
                $query->where('student.name', 'like', '%' . $student_name . '%')
                    ->orWhere('student.last_name', 'like', '%' . $student_name . '%');
            });
        }
        if (self::isNotEmptyGet('class_id')) {
            $records = $records->where('student_attendances.class_id', Request::get('class_id'));
        }
        if (self::isNotEmptyGet('attendance_type')) {
            $records = $records->where('student_attendances.attendance_type', Request::get('attendance_type'));
        }
        if (self::isNotEmptyGet('start_attendance_date')) {
            $records = $records->where('student_attendances.attendance_date', '>=', Request::get('start_attendance_date'));
        }
        if (self::isNotEmptyGet('end_attendance_date')) {
            $records = $records->where('student_attendances.attendance_date', '<=', Request::get('end_attendance_date'));
        }
        $records = $records->orderBy('student_attendances.id', 'desc')
            ->paginate(50);

        return $records;
    }

    public static function getRecordsTeacher(array $classIds)
    {
        if (!empty($classIds)) {
            $records = self::select('student_attendances.*', 'class.name as class_name', 'student.name as student_name', 'student.last_name as student_last_name', 'creator.name as creator_name')
                ->join('class', 'class.id', 'student_attendances.class_id')
                ->join('users as student', 'student.id', 'student_attendances.student_id')
                ->join('users as creator', 'creator.id', 'student_attendances.created_by')
                ->whereIn('student_attendances.class_id', $classIds);
            if (self::isNotEmptyGet('student_id')) {
                $records = $records->where('student_attendances.student_id', Request::get('student_id'));
            }
            $student_name = Request::get('student_name');
            if (!empty($student_name)) {
                $records = $records->where(function ($query) use ($student_name) {
                    $query->where('student.name', 'like', '%' . $student_name . '%')
                        ->orWhere('student.last_name', 'like', '%' . $student_name . '%');
                });
            }
            if (self::isNotEmptyGet('class_id')) {
                $records = $records->where('student_attendances.class_id', Request::get('class_id'));
            }
            if (self::isNotEmptyGet('start_attendance_date')) {
                $records = $records->where('student_attendances.attendance_date', '>=', Request::get('start_attendance_date'));
            }
            if (self::isNotEmptyGet('end_attendance_date')) {
                $records = $records->where('student_attendances.attendance_date', '<=', Request::get('end_attendance_date'));
            }
            if (self::isNotEmptyGet('attendance_type')) {
                $records = $records->where('student_attendances.attendance_type', Request::get('attendance_type'));
            }
            $records = $records->orderBy('student_attendances.id', 'desc')
                ->paginate(50);

            return $records;
        }

        return "";

    }

    public static function getRecordsStudent($id)
    {
        $records = self::select('student_attendances.*', 'class.name as class_name')
            ->join('class', 'class.id', 'student_attendances.class_id')
            ->where('student_attendances.student_id', $id);
        if (self::isNotEmptyGet('class_id')) {
            $records = $records->where('student_attendances.class_id', Request::get('class_id'));
        }
        if (self::isNotEmptyGet('attendance_type')) {
            $records = $records->where('student_attendances.attendance_type', Request::get('attendance_type'));
        }
        if (self::isNotEmptyGet('start_attendance_date')) {
            $records = $records->where('student_attendances.attendance_date', '>=', Request::get('start_attendance_date'));
        }
        if (self::isNotEmptyGet('end_attendance_date')) {
            $records = $records->where('student_attendances.attendance_date', '<=', Request::get('end_attendance_date'));
        }
        $records = $records->orderBy('student_attendances.id', 'desc')
            ->paginate(50);

        return $records;
    }

    public static function getClassStudent($id)
    {
        return self::select('student_attendances.*', 'class.name as class_name')
            ->join('class', 'class.id', 'student_attendances.class_id')
            ->where('student_attendances.student_id', $id)
            ->groupBy('student_attendances.class_id')
            ->get();
    }

    private static function isNotEmptyGet(string $key): bool
    {
        return !empty(Request::get($key));
    }
}
