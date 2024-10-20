<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarkRegister extends Model
{
    use HasFactory;

    protected $table = 'mark_registers';

    public static function CheckAlreadyMark(mixed $student_id, mixed $exam_id, mixed $class_id, mixed $subject_id)
    {
        return self::where('student_id', $student_id)
            ->where('exam_id', $exam_id)
            ->where('class_id', $class_id)
            ->where('subject_id', $subject_id)
            ->first();
    }
}
