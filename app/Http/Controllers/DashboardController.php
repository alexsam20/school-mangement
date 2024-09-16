<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['header_title'] = 'Dashboard - ';
        $view = match ((int)Auth::user()->user_type) {
            1 => 'admin.dashboard',
            2 => 'teacher.dashboard',
            3 => 'student.dashboard',
            4 => 'parent.dashboard'
        };

        return view($view, $data);
    }
}
