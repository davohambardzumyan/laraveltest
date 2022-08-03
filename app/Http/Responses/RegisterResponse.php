<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use Laravel\Fortify\Fortify;

class RegisterResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();
        return $request->wantsJson()
            ? response()->json(['two_factor' => false, 'user' => $user])
            : redirect()->intended(Fortify::redirects('home'));
    }
}
