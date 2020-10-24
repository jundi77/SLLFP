<?php

namespace App\Models;

use App\Traits\UsesUUID;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use UsesUUID;

    protected $fillable = [
        'author_id', 'title', 'closed'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id', 'author_id');
    }

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }
}
