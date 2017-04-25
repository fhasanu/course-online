<?php

/*
SELECT * FROM <table> WHERE LOWER(<key>) LIKE LOWER('%<searchpattern>%')
*/

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

use App\Course;
use App\CourseDetail;
use App\CourseLevel;
use App\CourseAge;
use App\MainCategory;
use App\SubCategory;
use App\Provider;
use App\Region;
use App\Province;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('search');
    }

    public function search(Request $request)
    {
        $min = null;
        $max = null;
        // dd(request()->all());
        $target = $request->input('key');
        if (!isset($target) || $target == null): $target = ''; endif;
        $location = $request->input('location');
        if (!isset($target) || $location == null): $location = '';
        $min = $request->input('min'); endif;
        if (!isset($target) || $min == null): $min = 0; endif;
        $max = $request->input('max');
        if (!isset($target) || $max == null): $max = 1000000; endif;
        $age = $request->input('age');
        if (!isset($target) || $age == null): $age = ''; endif;
        $level = $request->input('level');
        if (!isset($target) || $level == null): $level = ''; endif;

        $query = DB::table('ak_course')
                    ->join('ak_course_detail', 'ak_course.ak_course_id', '=', 'ak_course_detail.ak_course_detail_id')
                    ->join('ak_course_level', 'ak_course_detail.ak_course_detail_level', '=', 'ak_course_level.ak_course_level_id')
                    ->join('ak_course_age', 'ak_course_detail.ak_course_detail_age', '=', 'ak_course_age.ak_course_age_id')
                    ->join('ak_sub_category', 'ak_course.ak_course_cat_id', '=', 'ak_sub_category.ak_subcat_id')
                    ->join('ak_provider', 'ak_course.ak_course_prov_id', '=', 'ak_provider.ak_provider_id')
                    ->join('ak_provider_img', 'ak_provider.ak_provider_id', '=', 'ak_provider_img.ak_provider_id')
                    ->join('ak_region', 'ak_provider.ak_provider_region', '=', 'ak_region.ak_region_id')
                    ->join('ak_province', 'ak_region.ak_region_prov_id', '=', 'ak_province.ak_province_id')
                    ->select('ak_course.ak_course_id','ak_course.ak_course_name', 'ak_course_level.ak_course_level_name', 'ak_sub_category.ak_subcat_name', 'ak_course_age.ak_course_age_name_id', 'ak_course_detail.ak_course_detail_price', 'ak_course_detail.ak_course_detail_desc', 'ak_provider_img.ak_provider_img_path')
                    ->where(function ($query) use ($target) {
                        return $query->where('ak_course.ak_course_name', 'ilike', '%'.$target.'%')
                        ->orWhere('ak_course_detail.ak_course_detail_desc', 'ilike', '%'.$target.'%')
                        ->orWhere('ak_provider.ak_provider_firstname', 'ilike', '%'.$target.'%')
                        ->orWhere('ak_provider.ak_provider_lastname', 'ilike', '%'.$target.'%');
                    });
                    $query->where (function ($query) use ($location) {
                        return $query->where('ak_region.ak_region_name', 'ilike', '%'.$location.'%')
                        ->orWhere('ak_region.ak_region_namefull', 'ilike', '%'.$location.'%')
                        ->orWhere('ak_region.ak_region_cityname', 'ilike', '%'.$location.'%')
                        ->orWhere('ak_province.ak_province_name', 'ilike', '%'.$location.'%')
                        ->orWhere('ak_province.ak_province_name_idn', 'ilike', '%'.$location.'%');
                    });
                    $query->where (function ($query) use ($min, $max) {
                    return $query->where('ak_course_detail.ak_course_detail_price', '>=', $min)
                        ->where('ak_course_detail.ak_course_detail_price', '<=', $max);
                    });
                    $query->where (function ($query) use ($age) {
                        return $query->where('ak_course_age.ak_course_age_name_id', 'ilike', '%'.$age.'%')
                        ->orWhere('ak_course_age.ak_course_age_name_eng', 'ilike', '%'.$age.'%');
                    });
                    $query->where (function ($query) use ($level) {
                        return $query->where('ak_course_level.ak_course_level_name', 'ilike', '%'.$level.'%');
                    });
        $courses = $query->get();
        return view('search')
            ->with('courses', $courses)
            ->with('target', $target)
            ->with('location', $location)
            ->with('min', $min)
            ->with('max', $max)
            ->with('age', $age)
            ->with('level', $level);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedule  = CourseSchedule::find($id);
        if(!$schedule)
            return redirect('/courses');

        $detail = CourseDetail::find($schedule->ak_course_schedule_detid);

        return view('course_detail')->with('schedule', $schedule)->with('detail', $detail);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
