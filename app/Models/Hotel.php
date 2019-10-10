<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table= 'hotels';

    public $timestamps = true;

    // it don't change
    protected $guarded = [
        'id',
    ];

    protected $fillable = [];


    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */



    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function hotelGroup()
    {
        return $this->belongsTo(GroupHotel::class, 'group_hotel_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopeByName($query, $name)
    {
        return $query->where(\DB::raw('LOWER( name )'), 'LIKE' , '%'.strtolower($name).'%');
    }

    public function scopeByCity($query, $city)
    {
        return $query->where(\DB::raw('LOWER( city )'), 'LIKE' , '%'.strtolower($city).'%');
    }

    public function scopeByAddress($query, $address)
    {
        return $query->where(\DB::raw('LOWER( address )'), 'LIKE' , '%'.strtolower($address).'%');
    }

    public function scopeByStarts($query, $starts)
    {
        return $query->where('starts' , '<=', $starts);
    }


    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
