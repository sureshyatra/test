<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class LocationCity extends Model {
    protected $table = 'location_cities';
    protected $fillable = ['country_id','state_id','name','slug','meta'];
    protected $casts = ['meta' => 'array'];
    public function country(){ return $this->belongsTo(Country::class); }
    public function state(){ return $this->belongsTo(State::class); }
    public function getRouteKeyName(){ return 'slug'; }
}
