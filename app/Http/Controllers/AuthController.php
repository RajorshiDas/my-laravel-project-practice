<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Events\UserSubscribed;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;


use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        //Validate
        $field = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'email', 'unique:users'],
            'password' => ['required', 'min:3', 'confirmed'],
        ]);


        //Register
       $user = User::create($field);
        //Login
        Auth::login($user);

        event(new Registered($user));

        if ($request->subscribe) {
            event(new UserSubscribed($user));
        }
        //Redirect
        return redirect()->route('dashboard');
}

public function verifyNotice()
{
    return view('auth.verify-email');
}

public function varifyEmail(EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('dashboard')->with('success', 'Email verified successfully');
}

public function verifyEmailResend(Request $request) {

    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
}
//Login
public function login(Request $request)
{
    //Validate
    $fields = $request->validate([
        'email' => ['required', 'max:255', 'email'],
        'password' => ['required']
    ]);
    //Login
    if (Auth::attempt(['email' => $fields['email'], 'password' => $fields['password']], $request->has('remember'))) {
        return redirect()->intended('dashboard')->with('success', 'Welcome back!');
    } else {
        return back()->withErrors([
            'failed' => 'The provided credentials do not match our records.'
        ]);
    }
}
//Logout
public function logout(Request $request)
{
   Auth::logout();

   $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('dashboard')->with('success', 'Logged out successfully');


}
}
