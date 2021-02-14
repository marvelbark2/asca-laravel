<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function redirect($provider)
 {
     return Socialite::driver($provider)->redirect();
 }
 public function callback($provider)
 {
   $getInfo = Socialite::driver($provider)->user();
   $user = $this->createUser($getInfo,$provider);
   auth()->login($user);
   $role = Auth::user()->type;

        switch ($role) {
            case 'super_admin':
                    return redirect('/admin/taches') ;
                break;
            case 'user':
                    return redirect('/tache');
                break;
            case 'pending':
                return redirect('/pending');
            break;
            default:
                    return redirect('/login');
                break;
        }
 }
 function createUser($getInfo,$provider){
 $user = User::where('provider_id', $getInfo->id)->first();
 if (!$user) {
      $user = User::create([
         'name'     => $getInfo->name,
         'email'    => $getInfo->email,
         'provider' => $provider,
         'provider_id' => $getInfo->id,
         'type' => 'pending',
     ]);
   }
   return $user;
 }

}
