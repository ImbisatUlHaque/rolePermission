<?php

namespace App\Traits;

use App\Models\{
    Permission,
    Role
};

trait HasPermissionTrait{
    
    // Get all Permission
    public function getAllPermission($permission){
        return Permission::whereIn('slug',$permission)->get();
    }

    //Check permission of user
    public function hasPermission($permission){
        return (bool) $this->permissions->where('slug', $permission->slug)->count();
    }

    //Check roles of user
    public function hasRole(...$roles)
    {
        foreach ($roles as $role ) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }

        return false;
    }
    
    public function hasPermissionTo($permission)
    {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }

    //Checking permission of role
    public function hasPermissionThroughRole($permissions)
    {
        foreach ($permissions->role as $role ) {
            if ($this->role->contains($role)) {
                return true;
            }
        }
        return false;
    }

    //Give permission to User
    public function givePermission(...$permissions)
    {
        $permission = $this->getAllPermission($permissions);
        if ($permission == null) {
            return $this;
        }
        $this->permissions()->saveMany();

        return $this;

    }
    

    // Making Relations
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class,'users_roles');
    }
}