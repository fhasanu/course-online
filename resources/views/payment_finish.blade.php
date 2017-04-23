@extends('layouts.master')
@section('content')
<div class="panel panel-default">
<div class="panel panel-title">
	<h1>Pembayar</h1>
</div>
<div class="panel panel-body">
	<h3>Status 	:	{{ucfirst($snap->status_message)}}</h3>
	<h3>Harga	:	Rp. {{$snap->gross_amount}}</h3>
	<h3>Pembayaran:	{{ucfirst(preg_replace('/[^A-Za-z0-9\-]/', ' ', $snap->payment_type))}}</h3>	
	<h3>Waktu	:	{{$snap->transaction_time}}</h3>	
</div>
</div>
@endsection
