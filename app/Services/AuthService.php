<?php

namespace App\Services;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;


class AuthService
{
    public $request;
    public $guard;

    public function __construct($request = null, $guard = 'web')
    {
        $this->request = $request;
        $this->guard = $guard;
    }

    public function login()
    {
        $this->request->authenticate();
        if ($this->guard == 'web') {
            $this->request->session()->regenerate();
        } else if ($this->guard == 'api') {
            $token = $this->request->user()->createToken("Hello");
            return ['token' => $token->plainTextToken];
        }
    }

    public function logout()
    {

        if ($this->guard == 'web') {
            Auth::guard($this->guard)->logout();
            $this->request->session()->invalidate();
            $this->request->session()->regenerateToken();
        } else if ($this->guard == 'api') {
            Auth::logout();
        }
    }
}
