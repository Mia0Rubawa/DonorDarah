<?php

namespace App\Http\Controllers\Super;

use App\Helpers\SendResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(Request $request)
    {
        try {
            return view('akun.super.dashboard.index');
        } catch (\Exception $e) {

        }
    }
}
