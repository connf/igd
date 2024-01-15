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
        $games = 50;

        for ($i = 1; $i <= $games; $i++) {
            $userIds = $this->createFakeRowOfData();
            $game = \App\Models\Game::factory()->create($userIds);

            // for the game we just created get the id
            $memberScores["game_id"] = $game->game_id;

            // then for each member id of the game
            // get them a random score
            foreach($userIds as $field => $memberId) {
                $memberScores["member_id"] = $game->member_id;
                $memberScores["score"] = rand(1,10000);
            }

            // and save the scores too
            \App\Models\MemberScore::factory()->create($memberScores);
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
                $fields["member_id"] = $memberId;
                $fields["player_position"] = $currentlySeedingUser;
                $currentlySeededUsers[] = $memberId;
            }
        }

        return $fields;
    }
}
