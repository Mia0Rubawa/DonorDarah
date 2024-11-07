<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\SetRules;
use App\Http\Controllers\Controller;
use App\Models\Akun\Individu;
use App\Models\User;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use PDO;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showRegistrationForm()
    {

        return view('auth.register');
    }

    public function register(Request $request)
    {
        DB::beginTransaction();
        $json = ['status' => false, 'pesan' => 'Terdapat Kesalahan Sistem Dengan Kode : 500'];

        try {

            $set_rules = SetRules::setRules($request::except('_token'));

            $validator = Validator::make(
                $request::except('_token'),
                $set_rules['rules'],
                $set_rules['messages']
            );

            if ($validator->fails()) {

                $j = 0;
                $pesan = '';
                foreach ($validator->getMessageBag()->toArray() as $key => $error) {

                    foreach ($error as $key => $pesan_error) {
                        $pesan .=  ($j + 1) . '.' . $pesan_error . '</br>';
                    }
                    $j++;
                }
                $json['pesan'] = $pesan;
            } else {
                $akun = new Individu;
                $akun->username = $request::input('username');
                $akun->email = $request::input('email');
                $akun->password = Hash::make($request::input('password'));
                $akun->save();
                DB::commit();
                $json['status'] = true;
                $json['pesan'] = 'Berhasil, Akun Telah Terdaftar';
            }
        } catch (\Exception $e) {
            DB::rollBack();
            
        }
        return Response::json($json);
    }
}
