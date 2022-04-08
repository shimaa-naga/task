<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
//		$this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function login()
    {
        return view('admin.auth.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users|max:255',
            'password' => 'required|min:6|max:255',
        ]);
        $remember_me = request('remember_me') == 1 ? true : false;

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $remember_me)) {
            return redirect()->route('admin.home');
        }else {
            return redirect(route('admin.login'))
                ->withInput($request->only('email', 'remember_me'));
        }

    }

    public function logout() {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
