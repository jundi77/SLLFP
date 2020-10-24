<?php

namespace App\Models;

use App\Traits\UsesUUID;
use Illuminate\Database\Eloquent\Model;

class Failed_jobs extends Model
{
    use UsesUUID;
    protected $table = 'failed_jobs';
}
