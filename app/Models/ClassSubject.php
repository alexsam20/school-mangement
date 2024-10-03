<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class ClassSubject extends Model
{
    use HasFactory;

    protected $table = 'class_subject';

    public static function getSingle($id)
    {
        return self::find($id);
    }

    public static function getRecords()
    {
        $records = self::select('class_subject.*', 'class.name as class_name', 'subjects.name as subject_name', 'users.name as created_by_name')
            ->join('subjects', 'subjects.id', '=', 'class_subject.subject_id')
            ->join('class', 'class.id', '=', 'class_subject.class_id')
            ->join('users', 'users.id', '=', 'class_subject.created_by')
            ->where('class_subject.is_delete', 0);

        if (!empty(Request::get('class_name'))) {
            $records = $records->where('class.name', 'like', '%' . Request::get('class_name') . '%');
        }
        if (!empty(Request::get('subject_name'))) {
            $records = $records->where('subjects.name', 'like', '%' . Request::get('subject_name') . '%');
        }
        if (!empty(Request::get('date'))) {
            $records = $records->whereDate('class_subject.created_at', '=', Request::get('date'));
        }

        $records = $records->orderBy('class_subject.id', 'desc')
            ->paginate(20);

        return $records;
    }

    public static function mySubject($class_id)
    {
        return self::select('class_subject.*', 'subjects.name as subject_name', 'subjects.type as subjects_type')
            ->join('subjects', 'subjects.id', '=', 'class_subject.subject_id')
            ->join('class', 'class.id', '=', 'class_subject.class_id')
            ->join('users', 'users.id', '=', 'class_subject.created_by')
            ->where('class_subject.class_id', $class_id)
            ->where('class_subject.is_delete', 0)
            ->where('class_subject.status', 0)
            ->orderBy('class_subject.id', 'desc')
            ->get();
    }

    public static function getAlreadyFirst(mixed $class_id, mixed $subject_id)
    {
        return self::where('class_id', $class_id)
            ->where('subject_id', $subject_id)->first();
    }

    public static function getAssignSubjectID($class_id)
    {
        return self::where('class_id', $class_id)
            ->where('is_delete', 0)->get();
    }

    public static function deleteSubject(mixed $class_id)
    {
        return self::where('class_id', $class_id)->delete();
    }
}
