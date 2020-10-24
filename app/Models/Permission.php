<?php

namespace App\Models;

use App\Traits\UsesUUID;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use UsesUUID;

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_permissions');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_permissions');
    }
}
