@extends('layouts.master')

@section('content')
<div class="panel">
        <form method="POST" action="{{route('course.store.submit')}}">
        {{ csrf_field() }}

        <!-- Start the Copas -->
        <label for="name">Nama</label> 
        <div class="form-group">
            <input class="form-control" required name="name" id="name" type="text">
        </div>
        <label for="maincat">Main Catagory</label> 
        <div class="form-group">
            <select class="form-control" required name="maincat" id="maincat">
                <option value="" disabled selected hidden>Main Catagory</option>
                @foreach($maincat as $i)
                    <option value="{{$i->ak_maincat_id}}">{{$i->ak_maincat_name}}</option>
                @endforeach
            </select>
        </div>
        <label for="subcat">Sub Catagory</label> 
        <div class="form-group">
            <select class="form-control" required name="subcat" id="subcat">
                <option value="" disabled selected hidden>Sub Catagory</option>
                @foreach($subcat as $i)
                    <option data-id="{{$i->ak_subcat_parent}}" value="{{$i->ak_subcat_id}}">{{$i->ak_subcat_name}}</option>
                @endforeach
            </select>
        </div>        
        <label for="price">Price</label> 
        <div class="form-group">
            <input class="form-control" required name="price" id="price" type="number">
        </div>
        <label for="level">Level</label> 
        <div class="form-group">
            <select class="form-control" required name="level" id="level">
                <option value="" disabled selected hidden>Level</option>
                <option value="1">PEMULA</option>
                <option value="2">MENENGAH</option>
                <option value="3">MAHIR</option>
            </select>
        </div>
        <label for="age">Age</label> 
        <div class="form-group">
            <select class="form-control" required name="age" id="age">
                <option value="" disabled selected hidden>Age</option>
                <option value="1">ANAK-ANAK</option>
                <option value="2">REMAJA</option>
                <option value="3">DEWASA</option>
            </select>
        </div>
        <label for="size">Size</label> 
        <div class="form-group">
            <input class="form-control" required name="size" id="size" type="number">
        </div>
        <label for="description">Description</label> 
        <div class="form-group">
            <textarea class="form-control" rows="3" name="description" id="description"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">SUBMIT</button>
        </div>
        <!-- End the Copas -->
        </form>
      </div>
@endsection
