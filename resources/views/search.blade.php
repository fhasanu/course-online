@extends('layouts.master')

@section('content')
<form method="POST" action="/search">
    {{ csrf_field() }}
    <div class="form-inline row space">
        <?php function getValue($var){
            if (isset($var)) {
                if (strlen($var) > 0) {
                    echo str_replace("%", "", $var);
                }
            }
        }?>
        <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
            <input type="text" class="sharp-box space-item height-big" id="key" name="key" value="<?php getValue($target); ?>" placeholder="Search all courses by keyword">
        </div>
        <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
            <input type="text" class="sharp-box space-item height-big" id="location" name="location" value="<?php getValue($location); ?>" placeholder="region">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <button class="btn btn-danger sharp-box space-item height-big" type="submit">Search</button>
        </div>
    </div>
    <div class="form-inline row space margin-up-big">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
            <input type="number" class="sharp-box space-item height-med" id="min" name="min" value="<?php if (isset($max)): echo $min; endif; ?>" placeholder="min price">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
            <input type="number" class="sharp-box space-item height-med" id="max" name="max" value="<?php if (isset($max)): echo $max; endif; ?>" placeholder="max price">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
            <input type="text" class="sharp-box space-item height-med" id="age" name="age" value="<?php getValue($age); ?>" placeholder="by age">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
            <input type="text" class="sharp-box space-item height-med" id="level" name="level" value="<?php getValue($level); ?>" placeholder="by level">
        </div>
    </div>
</form>

@if (isset($courses))
<?php $result = 0; ?>
<div class="space">
@foreach ($courses as $course)
    <div class="panel panel-danger sharp-box space-item course">
        <div class="panel-body row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <img src="{{ $course->ak_provider_img_path }}">
            </div>
            <div class="parent col-lg-8 col-md-8 col-sm-8 col-xs-8">
                <h1 class=""><a href="{{ URL::to('/courses/' . $course->ak_course_id) }}">{{ $course->ak_course_name }}</a></h1>
                <h2 class="margin-left-sml child set-up set-right red">Rp {{ $course->ak_course_detail_price }}</h2>
                <h2 class="float-normal">{{ $course->ak_subcat_name }}   <span class="label label-success">{{ $course->ak_course_level_name }}</span>  <span class="label label-primary">{{ $course->ak_course_age_name_eng }}</span></h2>
                <p class="margin-down-sml">{{ $course->ak_course_detail_desc }}</p>
                <form class="addToCartForm">
                    <input type='hidden' name='courseid' value="{{ $course->ak_course_id }}">
                    <button class="addToCart margin-down-big child set-bottom set-right btn btn-danger width-sml sharp-box" data="{{$course->ak_course_id}}">Add Cart</button>
                </form>
            </div>
        </div>
    </div>
    <?php $result = $result + 1; ?>
@endforeach
</div>
    <?php if ($result > 0) {
        echo "<p class='result-text'>Returned ".$result." courses.</p>";
    } ?>
@else
    <?php
        if (!isset($result)) {
            echo "<p class='result-text'>Search anything!</p>";
        }
        else {
            echo "<p class='result-text'>No result matched!</p>";
        }
    ?>
@endif

@endsection
