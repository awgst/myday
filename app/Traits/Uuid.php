<?php

namespace App\Traits;
use Illuminate\Support\Str;

trait Uuid
{
    protected static function bootUuid()
    {
        self::creating(function($model){
            $model->uuid = Str::uuid();
        });

        self::updating(function($model){
            if (is_null($model->uuid)) {
                $model->uuid = Str::uuid();
            }
        });
    }
}