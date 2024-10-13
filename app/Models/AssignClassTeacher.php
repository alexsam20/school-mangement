<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class AssignClassTeacher extends Model
{
    use HasFactory;

    protected $table = 'assign_class_teacher';

    public static function getSingle($id)
    {
        return self::find($id);
    }

    public static function getRecords()
    {
        $query = self::select('assign_class_teacher.*', 'class.name as class_name', 'teacher.name as teacher_name', 'teacher.last_name as teacher_last_name', 'users.name as created_by_name')
            ->join('users as teacher', 'teacher.id', '=', 'assign_class_teacher.teacher_id')
            ->join('class', 'class.id', '=', 'assign_class_teacher.class_id')
            ->join('users', 'users.id', '=', 'assign_class_teacher.created_by')
            ->where('assign_class_teacher.is_delete', 0);
        if (!empty(Request::get('class_name'))) {
            $query = $query->where('class.name', 'like', '%' . Request::get('class_name') . '%');
        }
        if (!empty(Request::get('teacher_name'))) {
            $query = $query->where('teacher.name', 'like', '%' . Request::get('teacher_name') . '%');
        }
        if (!empty(Request::get('status'))) {
            $status = (Request::get('status') == 100) ? 0 : 1;
            $query = $query->where('assign_class_teacher.status', $status);
        }
        if (!empty(Request::get('date'))) {
            $query = $query->whereDate('assign_class_teacher.created_at', Request::get('date'));
        }

        return $query->orderBy('assign_class_teacher.id', 'desc')->paginate(20);
    }

    public static function getMyClassSubject($teacher_id)
    {
        return self::select('assign_class_teacher.*', 'class.name as class_name', 'subjects.name as subject_name',
            'subjects.type as subject_type', 'class.id as class_id', 'subjects.id as subject_id')
            ->join('class', 'class.id', 'assign_class_teacher.class_id')
            ->join('class_subject', 'class_subject.class_id', 'class.id')
            ->join('subjects', 'subjects.id', 'class_subject.subject_id')
            ->where('assign_class_teacher.status', 0)
            ->where('assign_class_teacher.is_delete', 0)
            ->where('subjects.status', 0)
            ->where('subjects.is_delete', 0)
            ->where('class_subject.status', 0)
            ->where('class_subject.is_delete', 0)
            ->where('assign_class_teacher.teacher_id', $teacher_id)
            ->get();
    }

    public static function getMyClassSubjectGroup($teacher_id)
    {
        return self::select('assign_class_teacher.*', 'class.name as class_name', 'class.id as class_id')
            ->join('class', 'class.id', 'assign_class_teacher.class_id')
            ->where('assign_class_teacher.status', 0)
            ->where('assign_class_teacher.is_delete', 0)
            ->where('assign_class_teacher.teacher_id', $teacher_id)
            ->groupBy('assign_class_teacher.class_id')
            ->get();
    }

    public static function getAlreadyFirst(mixed $class_id, mixed $teacher_id)
    {
        return self::where('class_id', $class_id)
            ->where('teacher_id', $teacher_id)->first();
    }

    public static function getAssignTeacherID($class_id)
    {
        return self::where('class_id', $class_id)
            ->where('is_delete', 0)->get();
    }

    public static function deleteTeacher(mixed $class_id)
    {
        return self::where('class_id', $class_id)->delete();
    }

    public static function getMyTimetable($class_id, $subject_id)
    {
        $week = Weeks::getWeekUsingName(date('l'));

        return ClassSubjectTimetable::getRecordClassSubject($class_id, $subject_id, $week->id);
    }
}
