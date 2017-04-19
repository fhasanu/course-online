<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'ak_region';
    protected $primaryKey = 'ak_region_id';

    protected $fillable = [
    	'ak_region_id',
        'ak_region_prov_id',
    	'ak_region_cityname',
        'ak_region_name',
        'ak_region_namefull',
        'ak_region_parent_id'
    ];

    public $timestamps = false;
}
