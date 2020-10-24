<?php

namespace App\Models;

use App\Traits\UsesUUID;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    // use UsesUUID;
    
    protected $fillable = [
        'respondent_id', 'choice_id'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id', 'respondent_id');
    }

    public function choices()
    {
        return $this->hasMany(Choice::class, 'id', 'choice_id');
    }
}
