@extends('layouts.master')
@section('content')
<h1>Payment Finish</h1>
<div class="panel panel-default">
<div class="panel panel-title">
	<h2>{{$snap->status_message}}</h2>	
</div>
<div class="panel panel-body">
	<h2>{{$snap->status_message}}</h2>
	<h2>{{$snap->gross_amount}}</h2>
	<h2>{{$snap->payment_type}}</h2>	
	<h2>{{$snap->va_numbers->bank}}</h2>	
</div>
</div>
@endsection
