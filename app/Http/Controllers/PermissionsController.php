<?php

namespace App\Http\Controllers;

use App\Services\PermissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionsController extends Controller
{
    public function createPermission(Request $request)
    {
        (new PermissionService(Auth::user(), ['guard_name' => 'web', 'name' => $request->name]))->createPermission();
    }

    public function setUserPermissions(Request $request)
    {
        (new PermissionService(Auth::user(), ['permissions' => $request->name]))->giveUserPermissions();
    }

    public function revokeUserPermissions(Request $request)
    {
        (new PermissionService(Auth::user(), ['permission' => $request->name]))->revokePermissions();
    }

    public function setUserRole(Request $request)
    {
        (new PermissionService(Auth::user(), ['roles' => $request->name]))->giveUserRoles();
    }
}
