<?php

namespace App\Services;

use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Role;

class RoleService
{
    protected $object;
    protected $role;


    public function __construct(Role $role = null, $object = null)
    {
        $this->object = $object;
        $this->role = $role;
    }

    public function giveRolePermissions(): void
    {
        $this->role->givePermissionTo($this->object['permissions']);
    }

    public function hasPermission(): bool
    {
        return $this->role->hasPermissionTo($this->object['permission']);
    }

    public function revokePermission(): void
    {
        $this->role->revokePermissionTo($this->object['permission']);
    }

    public function getRoleDetails(): array
    {
        $allPermissions = $this->role->permissions;
        $permissionNames = $allPermissions->pluck('id', 'name');
        $count = $this->role->permissions->count();
        return ['permissionNames' => $permissionNames, 'permissionCounts' => $count];
    }

    public function createRole(): void
    {
        Role::create($this->object);
        Artisan::call('cache:forget spatie.permission.cache');
        Artisan::call('cache:clear');
    }
}
