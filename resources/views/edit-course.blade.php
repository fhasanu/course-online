@extends('layouts.master')

@section('content')
<div class="panel">
        <form method="POST" action="{{url('provider/editcourse/'.$course->ak_provider_id)}}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <!-- Start the Copas -->
        <label for="name">Nama</label> 
        <div class="form-group">
            <input class="form-control" required name="name" id="name" type="text" value="{{$course->ak_course_name}}">
        </div>
        <label for="maincat">Main Catagory</label> 
        <div class="form-group">
            <select class="form-control" required name="maincat" id="editmaincat">
                @foreach($maincat as $i)
                    @if($i->ak_maincat_id === $course->ak_maincat_id)
                        <option value="{{$i->ak_maincat_id}}" selected>{{$i->ak_maincat_name}}</option>
                    @else
                        <option value="{{$i->ak_maincat_id}}">{{$i->ak_maincat_name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <label for="subcat">Sub Catagory</label> 
        <div class="form-group">
            <select class="form-control" required name="subcat" id="editsubcat">
                <option value="" disabled selected hidden>Sub Catagory</option>
                @foreach($subcat as $i)
                    @if($i->ak_subcat_id === $course->ak_subcat_id)
                        <option data-id="{{$i->ak_subcat_parent}}" value="{{$i->ak_subcat_id}}" selected>{{$i->ak_subcat_name}}</option>
                    @else
                        <option data-id="{{$i->ak_subcat_parent}}" value="{{$i->ak_subcat_id}}">{{$i->ak_subcat_name}}</option>
                    @endif
                @endforeach
            </select>
        </div>        
        <label for="price">Price</label> 
        <div class="form-group">
            <input class="form-control" required name="price" id="price" type="number">
        </div>
        <label for="level">Level</label> 
        <div class="form-group">
            <select class="form-control" required name="level" id="editlevel">
                <option value="1">PEMULA</option>
                <option value="2">MENENGAH</option>
                <option value="3">MAHIR</option>
            </select>
        </div>
        <label for="age">Age</label> 
        <div class="form-group">
            <select class="form-control" required name="age" id="editage">
                <option value="1">ANAK-ANAK</option>
                <option value="2">REMAJA</option>
                <option value="3">DEWASA</option>
            </select>
        <script type="text/javascript">
            $('#editlevel option[value='+{{$course->ak_course_level_id}}+']').attr('selected', true);
            $('#editage option[value='+{{$course->ak_course_age_id}}+']').attr('selected', true);
        </script>
        </div>
        <label for="size">Size</label> 
        <div class="form-group">
            <input class="form-control" required name="size" id="size" type="number" value={{$course->ak_course_detail_size}}>
        </div>
        <label for="description">Description</label> 
        <div class="form-group">
            <textarea class="form-control" rows="3" name="description" id="description" value={{$course->ak_course_detail_desc}}></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">SUBMIT</button>
        </div>
        <div class="form-group">
            <button type="reset" class="btn btn-primary">RESET</button>
        </div>

        <!-- End the Copas -->
        </form>
      </div>
@endsection
