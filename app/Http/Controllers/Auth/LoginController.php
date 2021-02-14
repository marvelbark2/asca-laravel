<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    public function redirectTo(){

        // User role
        $role = Auth::user()->type;

        // Check user role
        switch ($role) {
            case 'super_admin':
                    return '/admin/taches';
                break;
            case 'user':
                    return '/tache';
                break;
            default:
                    return '/login';
                break;
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout',
            'locked',
            'unlock'
        ]);
    }
    public function locked()
    {

        $id = Auth::user()->id;
        $user = \App\User::find($id);
        $user->lockout_time = '1';
        $user->save();
        return view('auth.locked');
    }

    public function unlock(Request $request)
    {
        $check = Hash::check($request->input('password'), $request->user()->password);

        if ($check) {
            $id = Auth::user()->id;
            $user = \App\User::find($id);
            $user->lockout_time = '0';
            $user->save();
            return redirect('/');
        }else{
            return redirect()->route('login.locked')->withErrors(
                'Your password does not match your profile.'
            );
        }


    }
}
