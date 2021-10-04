<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authrequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
    public function Login()
    {
        return view('auth.login');
    }
    public function postLogin(Authrequest $request)
    {
        $request->validated(); // validasi
        // $remember = $request->remember == 'on' ? true : false; // rememberme
        if (Auth::guard('petugas')->attempt(['username' => $request->username, 'password' => $request->password]))
        {
            $request->session()->regenerate();
            $level = Auth::guard('petugas')->user()->level;
            switch ($level) {
                case 'petugas':
                    return redirect()->intended('/petugas/dashboard');
                    break;
                case 'admin':
                    return redirect()->intended('/petugas/dashboard');
                    break;
            }
        }
        else if(Auth::guard('siswa')->attempt(['nisn' => $request->username, 'password' => $request->password]))
        {
            $request->session()->regenerate();
            return redirect('/siswa/dashboard');
        }
        else
        {
            return back()->withErrors([
                'username' => 'username anda salah',
                'password' => 'password anda salah'
            ]);
        }

    }
    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('login');
    }
}
