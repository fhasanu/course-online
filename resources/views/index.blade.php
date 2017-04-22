@extends('layouts.master')

@section('content')
<form method="POST" action="/search">
    {{ csrf_field() }}
    <div class="form-inline row space">
        <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
            <input type="text" class="sharp-box space-item height-big" id="key" name="key" value="<?php if (isset($target)): echo $target; endif; ?>" placeholder="Search all courses by keyword">
        </div>
        <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
            <input type="text" class="sharp-box space-item height-big" id="location" name="location" value="<?php if (isset($location)): echo $location; endif; ?>">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <button class="btn btn-danger sharp-box space-item height-big" type="submit">Search</button>
        </div>
    </div>
</form>
@endsection
