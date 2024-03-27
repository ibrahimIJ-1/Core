<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $users = (new UserService())->getAllUsers();
        return Inertia::render('User/Main', [
            'users' => $users,
            'can' => [
                'users_edit' => Auth::user()->can('users_edit', User::class),
            ],
        ]);
    }

    public function show()
    {
    }

    public function edit()
    {
    }

    public function delete()
    {
    }
}
