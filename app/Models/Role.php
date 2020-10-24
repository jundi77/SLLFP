<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUUID;

class Role extends Model
{
    use UsesUUID;

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_roles');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions');
    }
}
