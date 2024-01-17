<?php

namespace App\Http\Controllers;

use App\Repositories\MemberRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    private $memberRepository;

    public function __construct(MemberRepository $memberRepository)
    {
        $this->memberRepository = new MemberRepository();
    }

    public function view($id)
    {
        $member = $this->memberRepository->find($id);
        $joinedDate = $this->memberRepository->getJoinedDateForMember($member);
        $avgScore = $this->memberRepository->getAverageScoreForMember($member);
        $highScore = $this->memberRepository->getMaximumScoreForMember($member);
        
        return view('member')
            ->with([
                'member' => $member,
                'joinedDate' => $joinedDate,
                'avgScore' => $avgScore,
                'highScore' => $highScore
            ]);
    }
}
