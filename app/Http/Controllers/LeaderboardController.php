<?php

namespace App\Http\Controllers;

use App\Repositories\MemberRepository;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function view()
    {
        $mRepo = new MemberRepository();

        $memberScores = $mRepo->getTopMembers(10);

        return view('leaderboard')
            ->with([
                'memberScores'=> $memberScores
            ]);
    }
}
