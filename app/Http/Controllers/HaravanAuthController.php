<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class HaravanAuthController extends Controller
{
    public function index()
    {
        if (!empty(auth()->id())) {
            return redirect('dashboard');
        }

        return view('login.index');
    }

    public function redirectToProvider()
    {
        if (!empty(auth()->id())) {
            return redirect('dashboard');
        }

        $params = [
            'response_mode' => 'form_post',
            'response_type' => 'code id_token',
            'nonce' => Str::random(6)
        ];
        return Socialite::driver('haravan')->with($params)->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('haravan')->user();

        $dataUser = [
            'email' => $user->getEmail(),
        ];

        $dataValue = [
            'name' => $user->getName(),
            'password' => $user->token,
            'remember_token' => $user->token,
        ];

        $myUser = User::query()->updateOrCreate($dataUser, $dataValue);

        if (Auth::login($myUser)) {
            return route('dashboard');
        }

        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

}
