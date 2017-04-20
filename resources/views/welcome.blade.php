@extends('layouts.master')

@section('content')
{{Auth::user()->ak_user_id}}
@endsection