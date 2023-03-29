<?php

namespace Gigabait\Sso\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class SsoController extends Controller
{
    public function login(Request $request)
    {
        if ($request->has('auth_marker')) {
            try {
                $authMarkerData = json_decode(Crypt::decrypt($request->input('auth_marker')), true);

                $secretKey = config('sso.secret_key');
                if (hash_equals($authMarkerData['secret_key'], $secretKey)) {
                    $user = User::where('email', $authMarkerData['email'])->first();
                    if ($user) {
                        Auth::login($user);

                        return redirect()->intended('/dashboard');
                    }
                }
            } catch (\Exception $e) {
                // If something went wrong, go back to the login form
                return redirect('/login');
            }
        }

        return redirect('/login');
    }
}
