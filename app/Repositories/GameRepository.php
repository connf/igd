<?php

namespace App\Repositories;

use App\Controller\GameController;
use App\Controller\MemberScoreController;
use App\Models\Game;

class GameRepository
{
    public function find($uuid)
    {
        return Game::where("game_id", $uuid)->first();
    }
}