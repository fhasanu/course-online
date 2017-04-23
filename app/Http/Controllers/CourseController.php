<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Course;
use App\CourseDetail;
use App\CourseSchedule;
use App\Facility;
use App\Provider;
use App\ProviderImg;
use App\Region;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        foreach ($courses as $course) {
            $course->detail = CourseDetail::where('ak_course_id', $course->ak_course_id)->first();
        }
        return view('course')->with('courses', $courses);
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
        $course = new Course();
        $detail = new Detail();
        $schedules = [];

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);
        if(!$course)
            return redirect('/courses');

        $detail     = CourseDetail::where('ak_course_detail_id', $course->ak_course_id)->first();
        $schedules  = CourseSchedule::where('ak_course_schedule_detid', $detail->ak_course_detail_id)->get();
        $facilities = Facility::where('ak_course_facility_detid', $detail->ak_course_detail_id)->get();
        $query = DB::table('ak_course')
                    // ->join('ak_course_detail', 'ak_course.ak_course_id', '=', 'ak_course_detail.ak_course_detail_id')
                    // ->join('ak_course_schedule', 'ak_course_schedule.ak_course_schedule_detid', '=', 'ak_course_detail.ak_course_detail_id')
                    // ->join('ak_course_facility', 'ak_course_facility.ak_course_facility_detid', '=', 'ak_course_detail.ak_course_detail_id')
                    ->join('ak_provider', 'ak_provider.ak_provider_id', '=', 'ak_course.ak_course_prov_id')
                    ->join('ak_provider_img', 'ak_provider_img.ak_provider_id', '=', 'ak_provider.ak_provider_id')
                    ->join('ak_region', 'ak_region.ak_region_id', '=', 'ak_provider.ak_provider_region')
                    ->select('ak_course.ak_course_id', 'ak_course.ak_course_name', 'ak_provider.ak_provider_firstname', 'ak_provider.ak_provider_lastname', 'ak_provider.ak_provider_address', 'ak_provider.ak_provider_zipcode', 'ak_provider.ak_provider_telephone', 'ak_provider_img.ak_provider_img_path', 'ak_region.ak_region_cityname', 'ak_region.ak_region_name', 'ak_region.ak_region_namefull')
                    ->where('ak_course.ak_course_id', '=', $id);
        $result     = $query->first();
        // $provider   = Provider::where('ak_provider_id', $course->ak_course_prov_id)->first();
        // $image      = ProviderImg::where('ak_provider_img_id', $provider->ak_provider_id)->get();
        // $region     = Region::where('ak_region_id', $provider->ak_provider_region)->get();
        // dd($course);
        return view('course_detail', [

            'course' => $course,
            'result' => $result,
            'detail' => $detail,
            'schedules' => $schedules,
            'facilities' => $facilities,
            // 'provider' => $provider,
            // 'image' => $image,
            // 'region' => $region
        ]);
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
