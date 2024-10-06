<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSubjectTimetable extends Model
{
    use HasFactory;

    protected $table = 'class_subject_timetables';

    public static function getRecordClassSubject(mixed $class_id, mixed $subject_id, $week_id)
    {
        return self::where('class_id', $class_id)
            ->where('subject_id', $subject_id)
            ->where('week_id', $week_id)->first();
    }
}
