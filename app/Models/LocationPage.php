<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class LocationPage extends Model {
    protected $fillable = ['location_type','location_id','page_key','title','content','meta_title','meta_description'];
}
