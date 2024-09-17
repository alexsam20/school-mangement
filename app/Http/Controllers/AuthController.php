<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        if (!empty(Auth::check())) {
            $view = match ((int)Auth::user()->user_type) {
                1 => 'admin/dashboard',
                2 => 'teacher/dashboard',
                3 => 'student/dashboard',
                4 => 'parent/dashboard'
            };

            return redirect($view);
        }

        return view('auth.login');
    }

    public function authLogin(Request $request)
    {
        $remember = !empty($request->remember);
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $remember )) {
            $view = match ((int)Auth::user()->user_type) {
                1 => 'admin/dashboard',
                2 => 'teacher/dashboard',
                3 => 'student/dashboard',
                4 => 'parent/dashboard'
            };
            return redirect($view);
        } else {
            return redirect()->back()->with('error', 'Please enter valid email and password');
        }
    }

    public function PostForgotPassword(Request $request)
    {
        $user = User::getEmailSingle($request->email);
        if (!empty($user)) {
            $user->remember_token = Str::random(30);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return redirect()->back()->with('success', 'Please, check your email and reset your password');
        } else {
            return redirect()->back()->with('error', 'Email not found in the database');
        }

    }

    public function forgotPassword()
    {
        return view('auth.forgot');
    }

    public function reset($remember_token)
    {
        $user = User::getTokenSingle($remember_token);
        if (!empty($user)) {
            $data['user'] = $user;
            return view('auth.reset', $data);
        } else {
            abort(404);
        }
    }

    public function passwordReset($token, Request $request)
    {
        if ($request->password == $request->confirm_password) {
            $user = User::getTokenSingle($token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();

            return redirect(url(''))->with('success', 'Password successfully reset.');
        } else {
            return redirect()->back()->with('error', 'Password and confirm password does not match.');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect(url(''));
    }
}
