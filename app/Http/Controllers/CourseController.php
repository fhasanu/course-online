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
use App\MainCategory;
use App\SubCategory;
use Illuminate\Support\Facades\Auth;

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
        $subcat = SubCategory::all();
        $maincat = MainCategory::all();
        return view('create-course')
                ->with('maincat', $maincat)
                ->with('subcat', $subcat)
                ;
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
        $detail = new CourseDetail();
        $course->ak_course_name = $request->name;
        $course->ak_course_cat_id = $request->subcat;
        $course->ak_course_prov_id = Auth::user()->ak_provider_id;
        $course->save();
        $detail->ak_course_detail_name = $request->name . " detail";
        $detail->ak_course_detail_price = $request->price;
        $detail->ak_course_detail_level = $request->level;
        $detail->ak_course_detail_age = $request->age;
        $detail->ak_course_detail_size = $request->size;
        $detail->ak_course_detail_desc = $request->description;
        $detail->ak_course_id = $course->ak_course_id;
        $detail->save();
        for ($i=1; $i <= $request->jmlschedule; $i++) { 
            if(!is_null(request("day".$i)) && !is_null(request("time".$i))){
                $schedules = new CourseSchedule;
                $schedules->ak_course_schedule_detid = $detail->getId();
                $schedules->ak_course_schedule_day = request('day'.$i);
                $schedules->ak_course_schedule_time = request('time'.$i);
                $schedules->save();
            }
        }
        return redirect('/provider/dashboard');
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
                    ->join('ak_provider', 'ak_provider.ak_provider_id', '=', 'ak_course.ak_course_prov_id')
                    ->join('ak_provider_img', 'ak_provider_img.ak_provider_id', '=', 'ak_provider.ak_provider_id')
                    ->join('ak_region', 'ak_region.ak_region_id', '=', 'ak_provider.ak_provider_region')
                    ->select('ak_course.ak_course_id', 'ak_course.ak_course_name', 'ak_provider.ak_provider_firstname', 'ak_provider.ak_provider_lastname', 'ak_provider.ak_provider_address', 'ak_provider.ak_provider_zipcode', 'ak_provider.ak_provider_telephone', 'ak_provider_img.ak_provider_img_path', 'ak_region.ak_region_cityname', 'ak_region.ak_region_name', 'ak_region.ak_region_namefull')
                    ->where('ak_course.ak_course_id', '=', $id);
        $result     = $query->first();
        return view('course_detail', [

            'course' => $course,
            'result' => $result,
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
        $query = DB::table('ak_course')
                    ->join('ak_course_detail', 'ak_course.ak_course_id', '=', 'ak_course_detail.ak_course_id')
                    ->join('ak_course_level', 'ak_course_detail.ak_course_detail_level', '=', 'ak_course_level.ak_course_level_id')
                    ->join('ak_course_age', 'ak_course_detail.ak_course_detail_age', '=', 'ak_course_age.ak_course_age_id')
                    ->join('ak_sub_category', 'ak_course.ak_course_cat_id', '=', 'ak_sub_category.ak_subcat_id')
                    ->join('ak_main_category', 'ak_main_category.ak_maincat_id', '=', 'ak_sub_category.ak_subcat_parent')
                    ->join('ak_provider', 'ak_course.ak_course_prov_id', '=', 'ak_provider.ak_provider_id')
                    ->select('ak_course.ak_course_id','ak_provider.ak_provider_id','ak_course_detail.*','ak_main_category.ak_maincat_id','ak_course.ak_course_name', 'ak_course_level.ak_course_level_id', 'ak_sub_category.ak_subcat_id', 'ak_course_age.ak_course_age_id', 'ak_course_detail.ak_course_detail_price', 'ak_course_detail.ak_course_detail_desc')
                    ->where(function ($query) {
                        return $query
                        ->whereRaw('LOWER(ak_provider.ak_provider_email) like ?', Auth::user()->ak_provider_email);
                    })
                    ->where('ak_course.ak_course_id' , '=', $id);
        $courses = $query->first();

        $query = DB:: table('ak_provider_img')
                    ->where('ak_provider_id' , '=', Auth::id());

        $img = $query->first();

        $subcat = SubCategory::all();
        $maincat = MainCategory::all();
        return view('edit-course', [
            'maincat' => $maincat,
            'subcat' => $subcat,
            'course' => $courses,
            'image' => $img->ak_provider_img_path,
        ]);
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
        $course =Course::find($id);
        $course->ak_course_name = $request->name ;
        $course->ak_course_cat_id = $request->subcat;
        $course->save();   
        $detail = CourseDetail::where('ak_course_id', '=', $course->ak_course_id)->first();
        $detail->ak_course_detail_name = $request->name . " detail";
        $detail->ak_course_detail_price = $request->price;
        $detail->ak_course_detail_level = $request->level;
        $detail->ak_course_detail_age = $request->age;
        $detail->ak_course_detail_size = $request->size;
        $detail->ak_course_detail_desc = $request->description;
        $detail->save();
        return redirect('provider/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('ak_course')->insert([
            ['ak_course_name' => '', 'ak_course_cat_id' => 0, 'ak_course_prov_id' => ''],
        ]);
    }
}
