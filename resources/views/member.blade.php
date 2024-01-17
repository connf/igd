@extends('layout')

@section('title')
Member Page for {{ $member->first_name }} {{ $member->last_name }}
@endSection

@section('body')
<div>This is the member page for: <strong>{{ $member->first_name }} {{ $member->last_name }}</strong></div>
<div>Member Joined: <strong>{{ $joinedDate }}</strong></div>
<div>Average Score: <strong>{{ $avgScore }}</strong></div>
<div>Highest Score: <strong>{{ $highScore }}</strong></div>
@endSection