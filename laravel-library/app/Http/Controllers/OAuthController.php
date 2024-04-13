<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class OAuthController extends Controller
{
    function redirect(Request $request) {
        session()->put('state', $state = Str::random(40));

        session()->put('code_verifier', $code_verifier = Str::random(128));
    
        $codeChallenge = strtr(rtrim(base64_encode(hash('sha256', $code_verifier, true)), '='), '+/', '-_');
    
        $query = http_build_query([
            'client_id' => 1,
            'redirect_uri' => 'http://laravel-library.test/callback',
            'response_type' => 'code',
            'scope' => '',
            'state' => $state,
            'code_challenge' => $codeChallenge,
            'code_challenge_method' => 'S256',
            'prompt' => "login",
        ]);
    
        return redirect('http://laravel-student.test/oauth/authorize?'.$query);
    }

    function callback(Request $request) {
        $state = session()->pull('state');
 
        $codeVerifier = session()->pull('code_verifier');
     
        // dd($request, session());
        // dd(session());
        // dd($state);
        throw_unless(strlen($state) > 0 && $state === $request->state, InvalidArgumentException::class);
     
        $response = Http::asForm()->post('http://laravel-student.test/oauth/token', [
            'grant_type' => 'authorization_code',
            'client_id' => 1,
            'client_secret' => 'cZX8EhjRX0vxvzUR0d6YwgLMDtESepLbRamqegOf',
            'redirect_uri' => 'http://laravel-library.test/callback',
            'code_verifier' => $codeVerifier,
            'code' => $request->code,
        ]);
     
        return $response->json();
    }
}
