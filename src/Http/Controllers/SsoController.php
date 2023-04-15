<?php

namespace Gigabait\Sso\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Encryption\Encrypter;

class SsoController extends Controller
{
    public function login(Request $request)
    {
        if ($request->has('token')) {

            if ($request->has('param')) {
                $param = json_decode($request->input('param'));
                dd($param);
                if (isset($param['server'])) {
                    # code...
                }
            }



            $secretKey = config('sso.secret_key');
            if (strlen($secretKey) !== 32) {
                return redirect('/login')->withErrors(['sso_error' => 'Secret key length must be 32 characters.']);
            }
            $cipher = config('app.cipher');
            $encrypter = new Encrypter($secretKey, $cipher);
            $encryptedToken = $request->input('token');
            try {
                $decryptedToken = $encrypter->decrypt($encryptedToken);
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                return redirect('/login')->withErrors(['sso_error' => $e->getMessage()]);;
            }
            $authMarkerData = json_decode($decryptedToken, true);
            if (hash_equals($authMarkerData['secret_key'], $secretKey)) {
                $user = \DB::table('users')->where('email', $authMarkerData['email'])->first();
                if ($user) {
                    Auth::loginUsingId($user->id);
                    return redirect()->intended('/');
                }
            }
        }
        return redirect('/login');
    }
}
