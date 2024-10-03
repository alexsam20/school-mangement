<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return self::select('assign_class_teacher.*', 'class.name as class_name', 'teacher.name as teacher_name', 'teacher.last_name as teacher_last_name', 'users.name as created_by_name')
            ->join('users as teacher', 'teacher.id', '=', 'assign_class_teacher.teacher_id')
            ->join('class', 'class.id', '=', 'assign_class_teacher.class_id')
            ->join('users', 'users.id', '=', 'assign_class_teacher.created_by')
            ->where('assign_class_teacher.is_delete', 0)
            ->orderBy('assign_class_teacher.id', 'desc')
            ->paginate(20);
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
}
