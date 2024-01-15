<?php

namespace App\Models;

use BinaryCabin\LaravelUUID\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory, HasUUID;

    function getUUIDFieldName():string
    {
        return "game_id";
    }

    function members() {
        return $this->belongsToMany(Member::class, 'member_scores', 'member_id', 'member_id');
    }

    function scores() {
        return $this->hasMany(MemberScore::class, 'member_id');
    }
}
