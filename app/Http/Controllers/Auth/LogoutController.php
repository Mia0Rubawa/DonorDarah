<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\SendResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LogoutController extends Controller
{
    //
    public function logout(Request $request, $auth)
    {
        Auth::guard($auth)->logout();
        
        return SendResponse::determineLogoutAuth($auth);
    }
}
