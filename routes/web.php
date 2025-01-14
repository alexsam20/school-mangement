<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssignClassTeacherController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\ClassTimetableController;
use App\Http\Controllers\CommunicateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'authLogin']);
Route::get('logout', [AuthController::class, 'logout']);
Route::get('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('forgot-password', [AuthController::class, 'PostForgotPassword']);
Route::get('reset/{token}', [AuthController::class, 'reset']);
Route::post('reset/{token}', [AuthController::class, 'passwordReset']);

// Admin position middleware
Route::group(['middleware' => 'admin'], function () {
    // url admin
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('admin/admin/list', [AdminController::class, 'list']);
    Route::get('admin/admin/add', [AdminController::class, 'add']);
    Route::post('admin/admin/add', [AdminController::class, 'insert']);
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'update']);
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);
    // url teacher
    Route::get('admin/teacher/list', [TeacherController::class, 'list']);
    Route::get('admin/teacher/add', [TeacherController::class, 'add']);
    Route::post('admin/teacher/add', [TeacherController::class, 'insert']);
    Route::get('admin/teacher/edit/{id}', [TeacherController::class, 'edit']);
    Route::post('admin/teacher/edit/{id}', [TeacherController::class, 'update']);
    Route::get('admin/teacher/delete/{id}', [TeacherController::class, 'delete']);
    // url student
    Route::get('admin/student/list', [StudentController::class, 'list']);
    Route::get('admin/student/add', [StudentController::class, 'add']);
    Route::post('admin/student/add', [StudentController::class, 'insert']);
    Route::get('admin/student/edit/{id}', [StudentController::class, 'edit']);
    Route::post('admin/student/edit/{id}', [StudentController::class, 'update']);
    Route::get('admin/student/delete/{id}', [StudentController::class, 'delete']);
    // url parent
    Route::get('admin/parent/list', [ParentController::class, 'list']);
    Route::get('admin/parent/add', [ParentController::class, 'add']);
    Route::post('admin/parent/add', [ParentController::class, 'insert']);
    Route::get('admin/parent/edit/{id}', [ParentController::class, 'edit']);
    Route::post('admin/parent/edit/{id}', [ParentController::class, 'update']);
    Route::get('admin/parent/my-student/{id}', [ParentController::class, 'myStudent']);
    Route::get('admin/parent/assign_student_parent/{student_id}/{parent_id}', [ParentController::class, 'AssignStudentParent']);
    Route::get('admin/parent/assign_student_parent_delete/{student_id}', [ParentController::class, 'AssignStudentParentDelete']);
    Route::get('admin/parent/delete/{id}', [ParentController::class, 'delete']);
    // url class
    Route::get('admin/class/list', [ClassController::class, 'list']);
    Route::get('admin/class/add', [ClassController::class, 'add']);
    Route::post('admin/class/add', [ClassController::class, 'insert']);
    Route::get('admin/class/edit/{id}', [ClassController::class, 'edit']);
    Route::post('admin/class/edit/{id}', [ClassController::class, 'update']);
    Route::get('admin/class/delete/{id}', [ClassController::class, 'delete']);
    // url subject
    Route::get('admin/subject/list', [SubjectController::class, 'list']);
    Route::get('admin/subject/add', [SubjectController::class, 'add']);
    Route::post('admin/subject/add', [SubjectController::class, 'insert']);
    Route::get('admin/subject/edit/{id}', [SubjectController::class, 'edit']);
    Route::post('admin/subject/edit/{id}', [SubjectController::class, 'update']);
    Route::get('admin/subject/delete/{id}', [SubjectController::class, 'delete']);
    // url assign_subject
    Route::get('admin/assign_subject/list', [ClassSubjectController::class, 'list']);
    Route::get('admin/assign_subject/add', [ClassSubjectController::class, 'add']);
    Route::post('admin/assign_subject/add', [ClassSubjectController::class, 'insert']);
    Route::get('admin/assign_subject/edit/{id}', [ClassSubjectController::class, 'edit']);
    Route::post('admin/assign_subject/edit/{id}', [ClassSubjectController::class, 'update']);
    Route::get('admin/assign_subject/edit_single/{id}', [ClassSubjectController::class, 'edit_single']);
    Route::post('admin/assign_subject/edit_single/{id}', [ClassSubjectController::class, 'update_single']);
    Route::get('admin/assign_subject/delete/{id}', [ClassSubjectController::class, 'delete']);
    // url class_timetable
    Route::get('admin/class_timetable/list', [ClassTimetableController::class, 'list']);
    Route::post('admin/class_timetable/get_subject', [ClassTimetableController::class, 'get_subject']);
    Route::post('admin/class_timetable/add', [ClassTimetableController::class, 'insert_update']);
    // url assign_class_teacher
    Route::get('admin/assign_class_teacher/list', [AssignClassTeacherController::class, 'list']);
    Route::get('admin/assign_class_teacher/add', [AssignClassTeacherController::class, 'add']);
    Route::post('admin/assign_class_teacher/add', [AssignClassTeacherController::class, 'insert']);
    Route::get('admin/assign_class_teacher/edit/{id}', [AssignClassTeacherController::class, 'edit']);
    Route::post('admin/assign_class_teacher/edit/{id}', [AssignClassTeacherController::class, 'update']);
    Route::get('admin/assign_class_teacher/edit_single/{id}', [AssignClassTeacherController::class, 'edit_single']);
    Route::post('admin/assign_class_teacher/edit_single/{id}', [AssignClassTeacherController::class, 'update_single']);
    Route::get('admin/assign_class_teacher/delete/{id}', [AssignClassTeacherController::class, 'delete']);
    // url examinations
    Route::get('admin/examinations/exam/list', [ExamController::class, 'list']);
    Route::get('admin/examinations/exam/add', [ExamController::class, 'add']);
    Route::post('admin/examinations/exam/add', [ExamController::class, 'insert']);
    Route::get('admin/examinations/exam/edit/{id}', [ExamController::class, 'edit']);
    Route::post('admin/examinations/exam/edit/{id}', [ExamController::class, 'update']);
    Route::get('admin/examinations/exam/delete/{id}', [ExamController::class, 'delete']);
    Route::get('admin/examinations/exam_schedule', [ExamController::class, 'schedule']);
    Route::post('admin/examinations/exam_schedule_insert', [ExamController::class, 'scheduleInsert']);
    Route::get('admin/examinations/marks_register', [ExamController::class, 'marksRegister']);
    Route::post('admin/examinations/submit_marks_register', [ExamController::class, 'submitMarksRegister']);
    Route::post('admin/examinations/single_submit_marks_register', [ExamController::class, 'singleMarksRegister']);

    Route::get('admin/examinations/marks_grade', [ExamController::class, 'marksGrade']);
    Route::get('admin/examinations/marks_grade/add', [ExamController::class, 'marksGradeAdd']);
    Route::post('admin/examinations/marks_grade/add', [ExamController::class, 'marksGradeInsert']);
    Route::get('admin/examinations/marks_grade/edit/{id}', [ExamController::class, 'marksGradeEdit']);
    Route::post('admin/examinations/marks_grade/edit/{id}', [ExamController::class, 'marksGradeUpdate']);
    Route::get('admin/examinations/marks_grade/delete/{id}', [ExamController::class, 'marksGradeDelete']);

    Route::get('admin/attendance/student', [AttendanceController::class, 'attendanceStudent']);
    Route::post('admin/attendance/student/save', [AttendanceController::class, 'attendanceStudentSubmit']);
    Route::get('admin/attendance/report', [AttendanceController::class, 'attendanceReport']);

    Route::get('admin/communicate/notice_board', [CommunicateController::class, 'noticeBoard']);
    Route::get('admin/communicate/notice_board/add', [CommunicateController::class, 'addNoticeBoard']);
    Route::post('admin/communicate/notice_board/add', [CommunicateController::class, 'insertNoticeBoard']);
    Route::get('admin/communicate/notice_board/edit/{id}', [CommunicateController::class, 'editNoticeBoard']);
    Route::post('admin/communicate/notice_board/edit/{id}', [CommunicateController::class, 'updateNoticeBoard']);
    Route::get('admin/communicate/notice_board/delete/{id}', [CommunicateController::class, 'deleteNoticeBoard']);

    Route::get('admin/account', [UserController::class, 'myAccount']);
    Route::post('admin/account', [UserController::class, 'updateMyAccountAdmin']);
    Route::get('admin/change_password', [UserController::class, 'change_password']);
    Route::post('admin/change_password', [UserController::class, 'update_change_password']);
});

// Teacher position middleware
Route::group(['middleware' => 'teacher'], function () {
    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('teacher/account', [UserController::class, 'myAccount']);
    Route::post('teacher/account', [UserController::class, 'updateMyAccount']);
    Route::get('teacher/change_password', [UserController::class, 'change_password']);
    Route::post('teacher/change_password', [UserController::class, 'update_change_password']);
    Route::get('teacher/my_student', [StudentController::class, 'myStudent']);
    Route::get('teacher/my_class_subject', [AssignClassTeacherController::class, 'myClassSubject']);
    Route::get('teacher/my_class_subject/class_timetable/{class_id}/{subject_id}', [ClassTimetableController::class, 'myTimetableTeacher']);
    Route::get('teacher/my_exam_timetable', [ExamController::class, 'myExamTimetableTeacher']);
    Route::get('teacher/my_calendar', [CalendarController::class, 'myCalendarTeacher']);

    Route::get('teacher/marks_register', [ExamController::class, 'marksRegisterTeacher']);
    Route::post('teacher/submit_marks_register', [ExamController::class, 'submitMarksRegister']);
    Route::post('teacher/single_submit_marks_register', [ExamController::class, 'singleMarksRegister']);

    Route::get('teacher/attendance/student', [AttendanceController::class, 'attendanceStudentTeacher']);
    Route::post('teacher/attendance/student/save', [AttendanceController::class, 'attendanceStudentSubmit']);
    Route::get('teacher/attendance/report', [AttendanceController::class, 'attendanceReportTeacher']);

    Route::get('teacher/my_notice_board', [CommunicateController::class, 'myNoticeBoardTeacher']);
});

// Student position middleware
Route::group(['middleware' => 'student'], function () {
    Route::get('student/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('student/account', [UserController::class, 'myAccount']);
    Route::post('student/account', [UserController::class, 'updateMyAccountStudent']);
    Route::get('student/my_subject', [SubjectController::class, 'mySubject']);
    Route::get('student/my_timetable', [ClassTimetableController::class, 'myTimetable']);
    Route::get('student/my_exam_timetable', [ExamController::class, 'myExamTimetable']);
    Route::get('student/my_exam_result', [ExamController::class, 'myExamResult']);
    Route::get('student/my_attendance', [AttendanceController::class, 'myAttendanceStudent']);
    Route::get('student/my_notice_board', [CommunicateController::class, 'myNoticeBoardStudent']);
    Route::get('student/change_password', [UserController::class, 'change_password']);
    Route::post('student/change_password', [UserController::class, 'update_change_password']);
    Route::get('student/my_calendar', [CalendarController::class, 'myCalendar']);
});

// Parent position middleware
Route::group(['middleware' => 'parent'], function () {
    Route::get('parent/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('parent/account', [UserController::class, 'myAccount']);
    Route::post('parent/account', [UserController::class, 'updateMyAccountParent']);
    Route::get('parent/change_password', [UserController::class, 'change_password']);
    Route::post('parent/change_password', [UserController::class, 'update_change_password']);
    Route::get('parent/my_student/subject/{student_id}', [SubjectController::class, 'parentStudentSubject']);
    Route::get('parent/my_student/exam_timetable/{student_id}', [ExamController::class, 'parentMyExamTimetable']);
    Route::get('parent/my_student/exam_result/{student_id}', [ExamController::class, 'parentMyExamResult']);
    Route::get('parent/my_student/class_timetable/{class_id}/{subject_id}/{student_id}', [ClassTimetableController::class, 'myTimetableParent']);
    Route::get('parent/my_student/calendar/{student_id}', [CalendarController::class, 'myCalendarParent']);
    Route::get('parent/my_student/attendance/{student_id}', [AttendanceController::class, 'myAttendanceParent']);
    Route::get('parent/my_student', [ParentController::class, 'myStudentParent']);
    Route::get('parent/my_notice_board', [CommunicateController::class, 'myNoticeBoardParent']);
    Route::get('parent/my_student_notice_board', [CommunicateController::class, 'myStudentNoticeBoardParent']);
});

