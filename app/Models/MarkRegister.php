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

    public static function getExam($student_id)
    {
        return self::select('mark_registers.*', 'exams.name as exam_name')
            ->join('exams', 'exams.id', 'mark_registers.exam_id')
            ->where('mark_registers.student_id', $student_id)
            ->groupBy('mark_registers.exam_id')
            ->get();
    }

    public static function getExamSubject($exam_id, $student_id)
    {
        return self::select('mark_registers.*', 'exams.name as exam_name', 'subjects.name as subject_name')
            ->join('exams', 'exams.id', 'mark_registers.exam_id')
            ->join('subjects', 'subjects.id', 'mark_registers.subject_id')
            ->where('mark_registers.exam_id', $exam_id)
            ->where('mark_registers.student_id', $student_id)
            ->get();
    }
}
