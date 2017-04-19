<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table = 'ak_provider';
    protected $primaryKey = 'ak_provider_id';

    protected $fillable = [
    	'ak_provider_id',
        'ak_provider_firstname',
    	'ak_provider_lastname',
        'ak_provider_email',
        'ak_provider_password',
        'ak_provider_region',
        'ak_provider_address',
        'ak_provider_zipcode',
        'ak_provider_description',
        'ak_provider_telephone'
    ];

    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ak_provider_password',
    ];

}
