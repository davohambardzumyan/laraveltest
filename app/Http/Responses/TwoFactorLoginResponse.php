<?php

namespace App\Http\Responses;

use \Laravel\Fortify\Contracts\TwoFactorLoginResponse as TwoFactorLoginResponseContract;
use Laravel\Fortify\Fortify;

class TwoFactorLoginResponse implements TwoFactorLoginResponseContract
{

    public function toResponse($request)
    {
        $user = $request->user();
        return $request->wantsJson()
            ? response()->json(['user' => $user])
            : redirect()->intended(Fortify::redirects('login'));
    }
}
