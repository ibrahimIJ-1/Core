<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIAuthenticatedSessionController extends Controller
{
    public function store(LoginRequest $request): array
    {
        return (new AuthService($request, 'api'))->login();
    }

    public function destroy(Request $request): bool
    {
        (new AuthService($request, 'api'))->logout();
        return true;
    }
}
