<?php

namespace App\Models;

use App\Models\MemberScore;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    public $guarded = [];

    function games() {
        return $this->hasMany(Game::class);
    }

    function scores() {
        return $this->hasMany(MemberScore::class);
    }
}
