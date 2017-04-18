<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Course;
use App\CourseDetail;
use App\CourseSchedule;
use App\Facility;

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
        $course  = Course::find($id);
        if(!$schedule)
            return redirect('/courses');

        $detail     = CourseDetail::where('ak_course_id', $course->ak_course_id)->first();
        $schedules  = CourseSchedule::where('ak_course_schedule_detid', $detail->ak_course_detail_id)->get();
        $facilities = Facility::where('ak_course_facility_detid', $detail->ak_course_detail_id)->get();

        return view('course_detail', [
            'course' => $course,
            'detail' => $detail,
            'schedules' => $schedules,
            'facilities' => $facilities,
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
