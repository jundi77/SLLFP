<?php

namespace App\Traits;
use Illuminate\Support\Str;

trait UsesUUID
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post[$post->getKeyName()] = (string) Str::uuid();
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}