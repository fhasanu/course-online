@extends('layouts.master')

@section('content')
<h1>{{$course->ak_course_name}}</h1>
<h5>{{$detail->ak_course_detail_price}}</h5>
<h3>{{$detail->ak_course_detail_desc}}</h3>
<table>
	<thead>
		<tr>
			<td>Day</td>
			<td>Time</td>
		</tr>
	</thead>
	<tbody>
		@foreach($schedules as $schedule)

		<tr>
			<td>{{$schedule->ak_course_schedule_day}}</td>
			<td>{{$schedule->ak_course_schedule_time}}</td>
		</tr>

		@endforeach
	</tbody>
</table>

<button>hi there</button>
@endsection