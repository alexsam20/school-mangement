<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSchedule extends Model
{
    use HasFactory;

    protected $table = 'exam_schedules';

    public static function getRecordSingle($exam, $class, $subject)
    {
        return self::where('exam_id', $exam)
            ->where('class_id', $class)
            ->where('subject_id', $subject)
            ->first();
    }

    public static function deleteRecord(mixed $exam_id, mixed $class_id)
    {
        self::where('exam_id', $exam_id)
            ->where('class_id', $class_id)
            ->delete();
    }
}
