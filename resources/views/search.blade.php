@extends('layouts.master')

@section('content')

<form method="POST" action="/search">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="key">Search: </label>
        <input type="text" class="form-control" id="key" name="key" value="{{ @target }}">
    </div>
    <div class="form-group">
        <label for="location">Filter by Location : </label>
        <input type="text" class="form-control" id="location" name="location" value="{{ @location }}">
    </div>
    <div class="form-group">
        <label for="price">Filter by Price : </label>
        <label for="min">From : </label>
        <input type="number" class="form-control" id="min" name="min" value="{{ @min }}">
        <label for="max">To : </label>
        <input type="number" class="form-control" id="max" name="max" value="{{ @max }}">
    </div>
    <div class="form-group">
        <label for="age">Filter by Age : </label>
        <input type="text" class="form-control" id="age" name="age" value="{{ @age }}">
    </div>
    <div class="form-group">
        <label for="level">Filter by Level : </label>
        <input type="text" class="form-control" id="level" name="level" value="{{ @level }}">
    </div>
    <button class="btn btn-submit" type="submit">Search</button>
</form>

@if (isset($courses))
<?php $result = 0; ?>
@foreach ($courses as $course)
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">{{ @course-> }}</h3>
        </div>
        <div class="panel-body">

            {{ @course-> }}
        </div>
    </div>
    <?php $result = $result + 1; ?>
@endforeach
    <?php if ($result > 0) {
        echo "Returned ".$result." courses.";
    } ?>
@else
    <?php
        if (!isset($result)) {
            echo "Search anything!";
        }
        else {
            echo "No result matched!";
        }
    ?>
@endif
@endsection
