<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $games = 10;

        for ($i = 1; $i <= $games; $i++) {
            $userIds = $this->createFakeRowOfData();
            $game = \App\Models\Game::factory()->create($userIds);

            // for the game we just created get the id
            $memberScores["game_id"] = $game->id;

            // then for each member id of the game
            // replace _id with _score and set a random score
            foreach($userIds as $k => $v) {
                $memberScores[str_replace("_id", "_score", $k)] = rand(1,10000);
            }
            
            // and save the scores too
            \App\Models\MemberScore::factory()->create($memberScores);

            // and reset the $memberScores for the next record
            $memberScores = [];
        }
    }

    private function createFakeRowOfData($games = 10)
    {
        // As a game and member ID has to exist and a member cannot be in a game twice we cannot
        // seed random data from a factory we need to define our own rules to use existing IDs only once

        // Pick a random number of people to play a game between 2 and 4
        $players = rand(2,4);
        $currentlySeededUsers = [];

        // foreach player we want to seed a random ID but then pick a different ID next time
        for ($currentlySeedingUser = 1; $currentlySeedingUser <= $players; $currentlySeedingUser++) {

            // if we don't already have the current user id
            if(!in_array($currentlySeedingUser,$currentlySeededUsers)) {

                // pick a random user
                $memberId = \App\Models\Member::find(rand(1,30))->id;

                // grab the ID and store that we've already got this user so we don't get it again
                $fields["member_".$currentlySeedingUser."_id"] = $memberId;
                $currentlySeededUsers[] = $memberId;
            }
        }

        return $fields;
    }
}
