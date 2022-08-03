<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function me()
    {
        return response()->json(Auth::user());
    }
}
