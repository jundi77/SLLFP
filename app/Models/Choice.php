<?php

namespace App\Models;

use App\Traits\UsesUUID;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    use UsesUUID;

    protected $fillable = [
        'poll_id', 'value'
    ];

    public function polls()
    {
        return $this->hasMany(Poll::class, 'id', 'poll_id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
