<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Item extends Model
{
    // use HasFactory;
    protected $guarded = [];

    public function create_by(){
        return $this->hasOne(User::class);
    }

    public function order_by(){
        return $this->hasOne(User::class);
    }

    public function delete_by(){
        return $this->hasOne(User::class);
    }
    public function id(){
        return $this->hasMany(Item_history::class);
    }
}
