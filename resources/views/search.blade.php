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
    <div class="form-inline row space margin-up">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
            <input type="number" class="sharp-box space-item height-med" id="min" name="min" value="<?php if (isset($max)): echo $min; endif; ?>" placeholder="min price">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
            <input type="number" class="sharp-box space-item height-med" id="max" name="max" value="<?php if (isset($max)): echo $max; endif; ?>" placeholder="max price">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
            <input type="text" class="sharp-box space-item height-med" id="age" name="age" value="<?php if (isset($age)): echo $age; endif; ?>" placeholder="by age">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
            <input type="text" class="sharp-box space-item height-med" id="level" name="level" value="<?php if (isset($level)): echo $level; endif; ?>" placeholder="by level">
        </div>
    </div>
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
            <p>Detail : <a href="{{ URL::to('/courses/' . $course->ak_course_id) }}">DETAIL</a></p>
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
