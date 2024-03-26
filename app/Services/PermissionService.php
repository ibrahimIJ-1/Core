<?php

namespace App\Services;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;

class PermissionService
{
    protected $object;
    protected $user;

    public function __construct(User $user, $object = null)
    {
        $this->object = $object;
        $this->user = $user;
    }

    public function getAllPermission(): Collection
    {
        return $this->user->getAllPermissions();
    }

    public function giveUserRoles() : void
    {
        $this->user->assignRoles($this->object['roles']);
    }

    public function removeUserRoles() : void
    {
        $this->user->removeRole($this->object['role']);
    }

    public function checkUserRoles() : bool
    {
       return $this->user->hasRole($this->object['roles']);
    }

    public function giveUserPermissions() : void
    {
        $this->user->givePermissionTo($this->object['permissions']);
    }

    public function giveRolePermissions() : void
    {
        $this->object['role']->givePermissionTo($this->object['permissions']);
    }

    public function revokePermissions() : void
    {
        $this->user->revokePermissionTo($this->object['permission']);
    }

    public function hasPermissionTo() : bool
    {
       return $this->user->hasPermissionTo($this->object['permission']);
    }

    public function checkUserPermission() : bool
    {
        return $this->user->can($this->object['permission']);
    }

    public function hasAnyPermission() : bool
    {
       return $this->user->hasAnyPermission($this->object['permissions']);
    }

    public function hasAllRoles() : bool
    {
       return $this->user->hasAllRoles(Role::all());
    }

    public function createPermission() : void
    {
        Permission::create($this->object);
    }
}
