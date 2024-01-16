@extends('layout')

@section('title')
Member Page for {{ $member->first_name }} {{ $member->last_name }}
@endSection

@section('body')
<div>This is the member page for: <strong>{{ $member->first_name }} {{ $member->last_name }}</strong></div>
<div>Member Joined: <strong>{{ $joinedDate ?? '' }}</strong></div>
<div>Average Score: <strong>{{ $averageScore ?? 0 }}</strong></div>
<div>Highest Score: <strong>{{ $highestScore ?? 0 }}</strong></div>
@endSection