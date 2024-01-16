<?php

namespace App\Repositories;

use App\Controller\MemberController;
use App\Controller\MemberScoreController;
use App\Models\Member;
use Carbon\Carbon;

class MemberRepository
{
    // integer or string can be used if we were to be searching for guids or uuids instead of numerical
    public function find(int|string $id): ?Member
    {
        // We could override find with a findOrFail if this were a business case requirement
        // $member = Member::findOrFail($id);

        $member = Member::find($id);

        // Do anything else we may need to do business logic wise
        // if it were to be necessary - this is why a Repository can be a powerful tool
        // as an inbetween between the Task Code and Controller

        return $member;
    }

    public function getJoinedDateForMember(int|Member $member): string
    {
        /**
         * If we have been given an ID
         * Instead of the member record
         * Then get the record from the ID first
         */
        if (is_int($member)) {
            $member = $this->find($member);
        }

        // Return Created At DateTime in human-readable format
        return $member->created_at->format('l jS \o\f F Y h:i');
    }

    public function getAverageScoreForMember(int|Member $member): string
    {
        if (is_int($member)) {
            $member = $this->find($member);
        }

        $scores = $this->getScoresAsArray($member);

        // Shouldn't be needed for this game as all entries should contain a value
        // but this is a safety net a good validation for user data entry forms for example
        $scores = array_filter($member->scores->toArray());
        
        if(count($scores)) {
            return array_sum($scores)/count($scores);
        }
        return 0;
    }

    public function getMaximumScoreForMember(int|Member $member): string
    {
        if (is_int($member)) {
            $member = $this->find($member);
        }

        $scores = $this->getScoresAsArray($member);

        return max($scores);
    }

    private function getScoresAsArray(Member $member)
    {
        foreach($member->scores as $k => $score) {
            $scores[] = $score->score;
        }
        return $scores;
    }
}
