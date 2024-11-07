<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SendResponse
{

    public static function SendResponse($request) {}
    public static function SetRulesWithMessages($rules, $set_rules, $id = null)
    {
        $set_rules = $set_rules ? $set_rules : [!$id ? 'required' : ''];
    }
    public static function determineAuth()
    {
        foreach (array_keys(config('auth.guards')) as $guard) {
            if (Auth::guard($guard)->check()) {
                return $guard; // Return the name of the currently active guard
            }
        }
        return null; // Return null if no guard is authenticated
    }
    public static function determineLogoutAuth($auth)
    {

        switch ($auth) {
            case 'web':
                return Redirect::route('login-super');
                break;
            case 'individu':
                return Redirect::route('login');
                break;
            default:
                return Redirect::to('/');
        }
    }
}
