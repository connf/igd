<?php

namespace App\Repositories;

use App\Controller\MemberController;
use App\Controller\MemberScoreController;
use App\Models\Member;

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
}