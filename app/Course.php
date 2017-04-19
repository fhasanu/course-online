<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'ak_course';
    protected $primaryKey = 'ak_course_id';

    protected $fillable = [
<<<<<<< HEAD
    	'ak_course_name',
    	'ak_course_cat_id',
    	'ak_course_prov_id',
=======
    	'ak_course_id',
    	'ak_course_name',
        'ak_course_cat_id',
        'ak_course_prov_id'
>>>>>>> 1b8dcbba1200522569d91ab9181f98e037863c3f
    ];

    public $timestamps = false;
}
