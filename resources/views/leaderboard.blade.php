@extends('layout')

@section('title')
Leaderboard
@endSection

@section('body')
<table>
    <tr>
        <td><strong>Leaderboard</strong></td>
    <tr>
    <tr>
        <th>Name</th>
        <th>Score</th>
    </tr>
    @foreach($memberScores as $memberScore)
        <tr>
            <td>{{ $memberScore->member->first_name }} {{ $memberScore->member->last_name }}</td>
            <td>{{ $memberScore->score }}</td>
        </row>
    @endforeach
</table>
@endSection