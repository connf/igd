<?php

namespace App\Repositories;

use App\Controller\MemberController;
use App\Controller\MemberScoreController;
use App\Models\Member;
use Carbon\Carbon;

class MemberRepository
{
    public function create(array $data)
    {
        return Member::create($data);
    }

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

    /**
     * Maybe we want a find by field type search which we can override
     * This would let us pull records by email (as unique field) by default
     * or override this to pull where all last names are "this last name"
     */
    public function findBy(string $search, string $by = "email")
    {
        return Member::where($by, $search)->get();
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

        return $member->scores->pluck('score')->average();
    }

    public function getMinimumScoreForMember(int|Member $member): string
    {
        if (is_int($member)) {
            $member = $this->find($member);
        }

        return $member->scores->pluck('score')->min();
    }

    public function getMaximumScoreForMember(int|Member $member): string
    {
        if (is_int($member)) {
            $member = $this->find($member);
        }

        return $member->scores->pluck('score')->max();
    }
}
