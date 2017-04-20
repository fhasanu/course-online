@extends('layouts.master')

@section('content')

<form method="POST" action="/search">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="key">Search: </label>
        <input type="text" class="form-control" id="key" name="key" value="<?php if (isset($target)): echo $target; endif; ?>">
    </div>
    <div class="form-group">
        <label for="location">Filter by Location : </label>
        <input type="text" class="form-control" id="location" name="location" value="<?php if (isset($location)): echo $location; endif; ?>">
    </div>
    <div class="form-group">
        <label>Filter by Price : </label>
        <label for="min">From : </label>
        <input type="number" class="form-control" id="min" name="min" value="<?php if (isset($max)): echo $min; endif; ?>">
        <label for="max">To : </label>
        <input type="number" class="form-control" id="max" name="max" value="<?php if (isset($max)): echo $max; endif; ?>">
    </div>
    <div class="form-group">
        <label for="age">Filter by Age : </label>
        <input type="text" class="form-control" id="age" name="age" value="<?php if (isset($age)): echo $age; endif; ?>">
    </div>
    <div class="form-group">
        <label for="level">Filter by Level : </label>
        <input type="text" class="form-control" id="level" name="level" value="<?php if (isset($level)): echo $level; endif; ?>">
    </div>
    <button class="btn btn-submit" type="submit">Search</button>
</form>

@if (isset($courses))
<?php $result = 0; ?>
@foreach ($courses as $course)
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">{{ $course->ak_course_name }}</h3>
        </div>
        <div class="panel-body">
            <p>Level : {{ $course->ak_course_level_name }}</p>
            <p>Category : {{ $course->ak_subcat_name }}</p>
            <p>Age : {{ $course->ak_course_age_name_eng }}</p>
            <p>Price : {{ $course->ak_course_detail_price }}</p>
            <p>Desc : {{ $course->ak_course_detail_desc }}</p>
            <p>Link : <a href="{{url().'/corses'.$course->ak_course_id}}"></a></p>
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
