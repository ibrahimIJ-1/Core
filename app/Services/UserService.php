<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserService
{
    protected User $user;
    protected $id;

    public function __construct($id = null)
    {
        $this->id = $id;
        if ($id != null)
            $this->user = User::find($id);
    }

    public function getAllUsers(): AnonymousResourceCollection
    {
        return UserResource::collection(User::all());
    }
}
