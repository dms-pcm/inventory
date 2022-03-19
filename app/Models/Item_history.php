<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item_history extends Model
{
    // use HasFactory;
    protected $guarded = [];
    // public $timestamps = false;
    const UPDATED_AT = null;

    public function item_id(){
        return $this->hasOne(Item::class);
    }
    // public function delete_by(){
    //     return $this->hasOne(User::class);
    // }
}
