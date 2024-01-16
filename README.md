## INSTRUCTIONS

You will need your own .env which a copy of can be provided if required

You MAY also need to `composer require BinaryCabin\LaravelUUID` if not automatically installed with `composer install` as HasUuids is implemented into this application. This was a feature in Laravel 8 (maybe earlier) but was removed after 9.30 and the latest (current for this repo) version of Laravel which is 10 no longer uses this trait built in. This has been done to re-add functionality used in a version of Laravel to the current version and to demonstrate the use of composer packages within a Laravel application

## About Laravel Scrabble IGD

Laravel IGD is a Laravel Scrabble Membership Management System to log the members, scores and leaderboards of the members and the games they have played.

This is an example tool built to concept the idea request by IGD for a technical demonstration.

## Setup Instructions

- Clone the Repo
- Execute `php artisan serve`
- Navigate to the defined URL
- Check the Route files to see what rules can be utilised

In this latest development version the following features have been implemented:
[x] Models and Controllers Templates
[x] Test Templates
[x] Repository Templates
[x] Migrations
[x] Example Seeders
[x] Instructions on how to set up the system and use it on your own device
[x] Unit Test Templates
[] Views
[x] Example (non-usable) Routes
[x] Working Models
[] Working Controllers
[] Working Repositorires
[x] Working Seeders
[] Working Unit Tests

## The Technical Test Information

A scrabble club requires a system to store and update members’ details. They would like to see
and update their members' contact details. They would also like to see the following on the
member page:

- The date the member joined
- The members average score
- Highest score (when and which game)
- Recent games

All recorded scrabble games are played between 2-4 players, the player with the highest score
at the end of the game wins.

There should be a leaderboard page which shows the top 10 average member scores in order.

## Coding Requirements

This challenge is fairly open ended. Show us what you can do!
- Eloquent relationships
- Migrations
- Validation
- CRUD
- Simple UI
- Seeders / Factories
- Regular git commits as you develop

Feel free to add in extra features to show your understanding of PHP / Laravel. Please reach
out to us if you need extra information on the challenge. Submit your challenge to a git
repository for us to take a look. Make sure to make regular commits so that we can see your
progress