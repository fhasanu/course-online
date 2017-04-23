@extends('layouts.master')

@section('content')

<script type="text/javascript">
    var url = {!! '"'.url('/').'"' !!};
</script>


<div class="space row course">
	<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4">
		<img class="margin-down-big" src="{{ $result->ak_provider_img_path }}">
	</div>
	<div class="parent col-lg-9 col-md-9 col-sm-8 col-xs-8">
		<h1 class=""><a href="{{ URL::to('/courses/' . $course->ak_course_id) }}">{{ $result->ak_course_name }}</a></h1>
		<h2 class="margin-left-sml child set-up set-right red">Rp {{ $detail->ak_course_detail_price }}</h2>
		<form class="addToCartForm">
			<input type='hidden' name='courseid' value="{{ $course->ak_course_id }}">
			<button class="addToCart margin-down-big child set-right btn btn-danger width-sml sharp-box" data="{{$course->ak_course_id}}">Add Cart</button>
		</form>
		<h2 class="float-normal">{{ $course->ak_subcat_name }}   <span class="label label-success">{{ $course->ak_course_level_name }}</span>  <span class="label label-primary">{{ $course->ak_course_age_name_eng }}</span></h2>
		<p class="margin-down-sml">{{ $detail->ak_course_detail_desc }}</p>
		<p class="">Schedule : </p>
		<table class="width-big">
			<tbody>
				@foreach($schedules as $schedule)
				<tr>
					<td>{{$schedule->ak_course_schedule_day}}</td>
					<td>{{$schedule->ak_course_schedule_time}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<p class="margin-down-med">Event held by : {{ $result->ak_provider_firstname }}{{ $result->ak_provider_lastname }}</p>
		<p>Contact : {{ $result->ak_provider_telephone }}</p>
		<p>Location : {{ $result->ak_provider_address }}, {{ $result->ak_region_cityname }}, {{ $result->ak_region_namefull }}, {{ $result->ak_provider_zipcode }}</p>
	</div>
</div>

@endsection
