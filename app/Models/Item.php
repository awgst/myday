<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Item extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at'];

    protected $table = 'items';

    public function cards()
    {
        return $this->hasMany(Card::class, 'item_id', 'id');
    }

    public function tasks()
    {
        return $this->hasManyThrough(Task::class, Card::class, 'item_id', 'card_id');
    }

    protected static function boot()
    {
        self::creating(function ($model) {
            $model->user_id = Auth::user()->id;
        });
        parent::boot();
    }
}
