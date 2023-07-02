<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Validator;

class CustomAuthController extends Controller {

    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    public function process_login(Request $request) {

        $request->validate(['email' => 'required', 'password' => 'required']);
        $credentials = $request->only(['email', 'password']);

        if(Auth::attempt($credentials)) {
            if(Auth::user()->is_admin) {
                return redirect()->route('admin');
            }
            return redirect()->route('home');
        }

        return redirect()->back()->with('err', 'Email / Parola gresite');
    }

    public function process_registration(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'password-confirm' => 'required|same:password',
        ]);

        $user = User::create([
            'name' => trim($request->name),
            'email' => strtolower($request->email),
            'password' => bcrypt($request->password)
        ]);
        $user->is_admin = 0;

        if(Auth::attempt($request->only(['email', 'password']))) {
            return redirect()->route('home');    
        }

        return redirect()->route('tc');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

}
