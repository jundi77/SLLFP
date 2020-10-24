<?php

namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

trait PermissionRoleUtil
{

	public function permissions()
	{
		return $this->belongsToMany(Permission::class, 'users_permissions');
	}

	public function roles()
	{
		return $this->belongsToMany(Role::class, 'users_roles');
	}

	/**
	 * Get permission based on slug
	 */
	protected function getAllPermissionsThroughSlug(... $permissions)
	{
		return Permission::whereIn('slug', $permissions)->get();
	}

	protected function getAllRolesThroughSlug(... $roles)
	{
		return Role::whereIn('slug', $roles)->get();
	}

	protected function getRoleThroughSlug(String $role)
	{
		return Role::where('slug', $role)->get();
	}

	protected function getPermissionThroughSlug(String $permission)
	{
		return Role::where('slug', $permission)->get();
	}

	public function givePermissions(... $permissions)
	{
		$permissions = $this->getAllPermissionsThroughSlug($permissions);
		if ($permissions) {
			$this->permissions()->saveMany($permissions);
		}
		return $this;
	}

	public function removePermissions(... $permissions)
	{
		$permissions = $this->getAllPermissionsThroughSlug($permissions);
		$this->permissions()->detach($permissions);
		return $this;
	}

	public function resetPermissions(... $permissions)
	{
		$this->permissions()->detach();
		$this->givePermissions($permissions);

	}

	public function giveRoles(... $roles)
	{
		$roles = $this->getAllRolesThroughSlug($roles);
		if ($roles) {
			$this->roles()->saveMany($roles);
		}
		return $this;
	}

	public function removeRoles(... $roles)
	{
		$roles = $this->getAllRolesThroughSlug($roles);
		$this->roles()->detach($roles);
		return $this;
	}

	public function resetRoles(... $roles)
	{
		$this->roles()->detach();
		$this->giveRoles($roles);

	}
	
	protected function hasPermissionThroughRole(Permission $permission)
	{
		foreach ($permission->roles as $role) {
			if ($this->roles->contains('slug', $role)) {
				return true;
			}
		}
		return false;
	}

	protected function hasPermission(Permission $permission)
	{
		return (bool) $this->permissions->where('slug', $permission->slug)->count();
	}

	public function hasPermissionTo(Permission $permission)
	{
		return $this->hasPermission($permission) || $this->hasPermissionThroughRole($permission);
	}

	public function hasRoles(... $roles)
	{
		foreach ($roles as $role) {
			if ($this->roles->contains('slug', $role)) {
				return true;
			}
		}
		return false;
	}
}