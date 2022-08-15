<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\SendResetTokenMail;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request as Req;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Login');
    }

    public function forgotPassword()
    {
        return Inertia::render('Auth/ForgotPassword');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }
    public function setNewPassword()
    {
        return Inertia::render('Auth/NewPassword');
    }

    public function saveNewPassword()
    {
        Req::validate([
            'password' => 'min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ]);

        $email = Req::get('email');
        $token = Req::get('token');
        if(is_null($token))
        {
            return Redirect::back()->with('error', 'Invalid token please, try again.');
        }else{
            $record = \DB::table('password_resets')->where('email',$email)->where('token', $token)->first();
            if(is_null($record))
            {
                return Redirect::back()->with('error', 'Invalid token please, try again.');
            }else{
                 $user = \DB::table('users')->where('email', $email)->first();
                 $user->password =  Hash::make(Req::get('password'));
                 \DB::table('password_resets')->where('email',$email)->where('token', $token)->delete();
                 return Redirect::route('login')->with('success', 'Password was resetted successfully, login now');
            }
        }
    }


    public function resetEmail()
    {
        Req::validate([
            'email' => ['required', 'max:50', 'email']
        ]);

        $email = Req::get('email');
        $user = User::where('email',$email)->first();
        if(is_null($user))
        {
            return Redirect::route('forgot-password')->with('error', 'User record was not found.');
        }else{
            $token = Str::random(40);
            $record = \DB::table('password_resets')->where('email',$email)->first();
            if(is_null($record))
            {
                \DB::table('password_resets')->insert(
                    [
                    'email' => Req::get('email'),
                    'token' => $token
                    ]);
            }else{
                \DB::table('password_resets')->where('email',$email)->update(['token' => $token]);
            }

            $user->token = $token;

            \Mail::to($email)->send(new SendResetTokenMail($user));

            return Redirect::route('forgot-password')->with('success', 'A reset token has been emailed to you.');
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/users_activity');
    }
}
