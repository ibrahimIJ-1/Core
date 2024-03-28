<?php

namespace App\Http\Controllers;

use App\Services\RoleService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function createRole(Request $request)
    {
        (new RoleService(null, ['guard_name' => 'web', 'name' => $request->name]))->createRole();
    }

    public function setRolePermisson(Request $request)
    {
        (new RoleService(Role::find(1), ['permissions' => $request->name]))->giveRolePermissions();
    }
}
