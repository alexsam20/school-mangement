<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarksGrade extends Model
{
    use HasFactory;

    protected $table = 'marks_grades';

    public static function getSingle($id)
    {
        return self::find($id);
    }

    public static function getRecords()
    {
        return self::select('marks_grades.*', 'users.name as created_name')
            ->join('users', 'users.id', 'marks_grades.created_by')
            ->get();
    }

    public static function getGrade(float|int $percentage)
    {
        $gradeItem = self::select('marks_grades.*')
            ->where('percent_from', '<=', $percentage)
            ->where('percent_to', '>=', $percentage)
            ->first();

        return $gradeItem->name ?? '';
    }
}
