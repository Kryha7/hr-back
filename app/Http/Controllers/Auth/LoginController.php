<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }
    /**
     * Obtain the user information from Facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $social_user = Socialite::driver('facebook')->user();
        $findUser = User::where('facebook_id', $social_user->getId())->first();
        if ($findUser)
        {
            Auth::login($findUser);
            session()->flash('status', 'Zalogowałeś sie poprawnie');
            return redirect('/');
        }
        else
        {
            $randomPassword = str_random(30);
            $user = new User();
            $user->facebook_id = $social_user->getId();
            $user->name = $social_user->getName();
            $user->email = $social_user->getEmail();
            $user->password = bcrypt($randomPassword);
            $user->tickets = 0;
            $user->save();
            Auth::login($user);
            session()->flash('status', 'Zalogowałeś sie poprawnie');
            return redirect('/');
        }
    }
}
