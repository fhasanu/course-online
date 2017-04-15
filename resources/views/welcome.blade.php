@extends('layouts.master')

@section('content')
<?php
$url = parse_url(getenv("postgres://neckwlogcyduqj:4567149203fced87aacf01dd0e2552e8be3a0c0bd927f77e28165853802d5371@ec2-54-235-153-124.compute-1.amazonaws.com:5432/daju7u2osc727b"));

echo($url);
?>
	Testdrive
	HelloHai
@endsection