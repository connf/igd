<?php

namespace Tests\Unit;

use App\Models\Member;
use App\Repositories\MemberRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class MemberRepositoryTest extends TestCase
{
    public function testCanAddNewMember(): void
    {
        // Load the Repo we are testing
        $memberRepo = new MemberRepository();

        /**
         * Create some demo data
         * We will use this later to check it saved correctly
         */
        $memberToSave = [
            "first_name" => "First",
            "last_name" => "Last",
            "email" => "email".rand(0,9999999999)."@email.com",
            "created_at" => "2024-01-15 01:02:03"
        ];

        /** Let's create the record using the repo as we're testing the repo not the model */
        $member = $memberRepo->create($memberToSave);

        /**
         * Then assert that each of the fields we add is the same or equal to 
         * how they should be when pulled back from the DB / returned by the
         * create method
         */
        $this->assertSame($memberToSave["first_name"], $member->first_name);
        $this->assertSame($memberToSave["last_name"], $member->last_name);
        $this->assertSame($memberToSave["email"], $member->email);
        $this->assertEquals(Carbon::create($memberToSave["created_at"]), $member->created_at);
    }

    public function testCanFindMember(): void
    {
        $repo = new MemberRepository();
        $memberToSave = [
            "first_name" => "Testing",
            "last_name" => "ThisUser",
            "email" => "email".rand(0,9999999999)."@email.com"
        ];
        $memberToTest = $repo->create($memberToSave);
        $member = $repo->find($memberToTest->id);

        $this->assertSame($memberToSave["first_name"], $member->first_name);
        $this->assertSame($memberToSave["last_name"], $member->last_name);
    }

    public function testCanFindMemberByEmail(): void
    {
        $repo = new MemberRepository();
        $memberToSave = [
            "first_name" => "TestingFindByEmail",
            "last_name" => "ThisUser",
            "email" => "email".rand(0,9999999999)."@email.com"
        ];
        $memberToTest = $repo->create($memberToSave);

        // We could use the Member instance created by $memberToTest here 
        // but this is more indicative or real world scenarion where the searched
        // variable to find by would come from somewhere else first such as this array text
        $members = $repo->findBy($memberToSave["email"]); 

        $this->assertSame($memberToSave["first_name"], $members->first()->first_name);
        $this->assertSame($memberToSave["last_name"], $members->first()->last_name);
        $this->assertSame($memberToSave["email"], $members->first()->email);
    }

    public function testCanFindMemberByAnotherField(): void
    {
        $repo = new MemberRepository();
        $memberToSave = [
            // Usually in a production environment we would use a proper testing suite which rebuilds each run
            // Or we can randomly add digits to ensure we get different records each test run
            "first_name" => "testingbyfirstname".rand(0,9999999999),
            "last_name" => "testingbylastname".rand(0,9999999999),
            "email" => "email".rand(0,9999999999)."@email.com"
        ];
        $memberToTest = $repo->create($memberToSave);

        $field = "last_name";
        $members = $repo->findBy($memberToSave["last_name"], $field); 

        $this->assertSame($memberToSave["first_name"], $members->first()->first_name);
        $this->assertSame($memberToSave["last_name"], $members->first()->last_name);
        $this->assertSame($memberToSave["email"], $members->first()->email);

        $field = "first_name";
        $members = $repo->findBy($memberToSave["first_name"], $field); 

        $this->assertSame($memberToSave["first_name"], $members->first()->first_name);
        $this->assertSame($memberToSave["last_name"], $members->first()->last_name);
        $this->assertSame($memberToSave["email"], $members->first()->email);
    }

    public function testCanGetLowestAndHighestScoresForMember(): void
    {
        // Create a member to test with
        $repo = new MemberRepository();
        $memberToSave = [
            "first_name" => "lowest",
            "last_name" => "highest",
            "email" => "email".rand(0,9999999999)."@email.com"
        ];
        $member = $repo->create($memberToSave);

        // Add some scores where we know what the lowest and highest is so we know what
        // we should get in the results
        $scores = [
            1000 => 509,
            1001 => 9935, // highest
            1002 => 5, // lowest
            1003 => 45
        ];

        foreach ($scores as $game => $score) {
            DB::insert('insert into member_scores (game_id, member_id, score) values (?, ?, ?)', [$game, $member->id, $score]);
        }

        // Test we get the right ones
        $lowest = $repo->getMinimumScoreForMember($member);
        $this->assertEquals($lowest, 5);
        $highest = $repo->getMaximumScoreForMember($member);
        $this->assertEquals($highest, 9935);

    }

    public function testCanGetAverageScoreForMember(): void
    {

        // Create a member to test with
        $repo = new MemberRepository();
        $memberToSave = [
            "first_name" => "lowest",
            "last_name" => "highest",
            "email" => "email".rand(0,9999999999)."@email.com"
        ];
        $member = $repo->create($memberToSave);

        // Add some scores where we know what the lowest and highest is so we know what
        // we should get in the results
        $scores = [
            1000 => 1,
            1001 => 99,
        ];

        foreach ($scores as $game => $score) {
            DB::insert('insert into member_scores (game_id, member_id, score) values (?, ?, ?)', [$game, $member->id, $score]);
        }

        // Test we get the right ones
        $average = $repo->getAverageScoreForMember($member);
        $this->assertEquals($average, 50);
    }
}
