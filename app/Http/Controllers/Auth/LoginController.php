<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated($request, $user)
    {
        // Periksa status akun pada pengguna
        $status = $user->status;

        // Periksa apakah status saat login adalah 0
        if ($status === 0) {
            // Atur status akun menjadi 1 saat login
            $user->status = 1;
            $user->save();
        }
    }

    public function logout(Request $request)
    {
        // Ambil ID pengguna yang sedang logout
        $userId = Auth::user()->id;

        // Periksa pengguna
        $user = User::find($userId);

        // Periksa apakah pengguna ada
        if ($user) {
            // Periksa status akun pada pengguna
            $status = $user->status;

            // Periksa apakah status saat logout adalah 1
            if ($status === 1) {
                // Atur status akun menjadi 0 saat logout
                $user->status = 0;
                $user->save();
            }
        }

        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $this->loggedOut($request) ?: redirect('/login');
    }
}
