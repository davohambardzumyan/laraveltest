<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Fortify;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();
        return $request->wantsJson()
            ? response()->json(['two_factor' => false, 'user' => $user])
            : redirect()->intended(Fortify::redirects('login'));
    }
}
