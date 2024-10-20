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

    public static function getExam($class_id)
    {
        return self::select('exam_schedules.*', 'exams.name as exam_name')
            ->join('exams', 'exams.id', 'exam_schedules.exam_id')
            ->where('exam_schedules.class_id', $class_id)
            ->groupBy('exam_schedules.exam_id')
            ->orderBy('exam_schedules.id', 'desc')
            ->get();
    }

    public static function getExamTimetable($examId, $classId)
    {
        return self::select('exam_schedules.*', 'subjects.name as subject_name', 'subjects.type as subject_type')
            ->join('subjects', 'subjects.id', 'exam_schedules.subject_id')
            ->where('exam_schedules.exam_id', $examId)
            ->where('exam_schedules.class_id', $classId)
            ->oldest()
            ->get();
    }

    public static function getSubject($examId, $classId)
    {
        return self::select('exam_schedules.*', 'subjects.name as subject_name', 'subjects.type as subject_type')
            ->join('subjects', 'subjects.id', 'exam_schedules.subject_id')
            ->where('exam_schedules.exam_id', $examId)
            ->where('exam_schedules.class_id', $classId)
            ->oldest()
            ->get();
    }

    public static function getExamTimetableTeacher($teacher_id)
    {
        return self::select('exam_schedules.*', 'class.name as class_name', 'subjects.name as subject_name', 'exams.name as exam_name')
            ->join('assign_class_teacher', 'assign_class_teacher.class_id', 'exam_schedules.class_id')
            ->join('class', 'class.id', 'exam_schedules.class_id')
            ->join('subjects', 'subjects.id', 'exam_schedules.subject_id')
            ->join('exams', 'exams.id', 'exam_schedules.exam_id')
            ->where('assign_class_teacher.teacher_id', $teacher_id)
            ->get();
    }

    public static function getMark(mixed $student_id, mixed $exam_id, mixed $class_id, mixed $subject_id)
    {
        return MarkRegister::CheckAlreadyMark($student_id, $exam_id, $class_id, $subject_id);
    }
}
