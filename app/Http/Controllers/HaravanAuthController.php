<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class HaravanAuthController extends Controller
{
    public function redirectToProvider()
    {
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

        Log::debug($user);
    }
}
