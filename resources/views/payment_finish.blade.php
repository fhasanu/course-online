@extends('layouts.master')
@section('content')
{{var_dump($snap)}}
<div class="panel panel-default">
<div class="panel panel-title">
	<h1>Pembayaran Sukses</h1>
</div>
<div class="panel panel-body">
<ul>
	<li>Status 	:	{{ucfirst($snap->status_message)}}</li>
	<li>Harga	:	Rp. {{$snap->gross_amount}}</li>
	<li>Pembayaran:	{{ucfirst(preg_replace('/[^A-Za-z0-9\-]/', '', $snap->payment_type))}}</li>	
	<li>{{date(strtotime('d-m-Y H:i:s',$snap->transaction_time))}}</li>	
</ul>
</div>
</div>
@endsection
