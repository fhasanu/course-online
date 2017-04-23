@extends('layouts.master')

@section('content')
<form method="POST" action="/search">
    {{ csrf_field() }}
    <div class="form-inline row space">
        <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
            <input type="text" class="sharp-box space-item height-big" id="key" name="key" value="<?php if (isset($target)): echo $target; endif; ?>" placeholder="Search all courses by keyword">
        </div>
        <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">

<input data-minchars=0 class="awesomplete awesomplete-space-item sharp-box height-big" list="regionlist" type="text" name="location" id="location" value="<?php if (isset($location)): echo $location; endif; ?>" placeholder="Region"/>
<datalist id="regionlist">
    <option>Bekasi</option>
    <option>Bogor</option>
    <option>Depok</option>
    <option>Jakarta Selatan</option>
    <option>Jakarta Timur</option>
    <option>Jakarta Pusat</option>
    <option>Jakarta Barat</option>
    <option>Jakarta Utara</option>
    <option>Tangerang</option>
    <option>Tangerang Selatan</option>
</datalist>


     </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <button class="btn btn-danger sharp-box space-item height-big" type="submit">Search</button>
        </div>
    </div>
</form>
@endsection
