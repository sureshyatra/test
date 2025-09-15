<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TravelAgencies extends Model {
    protected $table = 'location_travel_agencies';
    protected $fillable = ['location_type','location_id','title','content','data','meta_title','meta_description','published_at'];
    protected $casts = ['data'=>'array','published_at'=>'datetime'];
}
