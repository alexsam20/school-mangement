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
