<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Exam extends Model
{
    use HasFactory;

    protected $table = 'exams';

    public static function getRecords()
    {
        $query = self::select('exams.*', 'users.name as created_name')
            ->join('users', 'users.id', 'exams.created_by')
            ->where('exams.is_deleted', null);
        if (!empty(Request::get('name'))) {
            $query = $query->where('exams.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('created_at'))) {
            $query = $query->whereDate('exams.created_at', Request::get('created_at'));
        }
        return $query->orderBy('exams.id', 'desc')
            ->paginate(50);
    }

    public static function getSingle($id)
    {
        return self::find($id);
    }

    public static function getExam()
    {
        return self::select('exams.*')
            ->join('users', 'users.id', 'exams.created_by')
            ->where('exams.is_deleted', null)
            ->orderBy('exams.name', 'asc')
            ->get();
    }
}
