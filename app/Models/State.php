<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class State extends Model {
    protected $fillable = ['country_id','name','slug','meta'];
    protected $casts = ['meta' => 'array'];
    public function country(){ return $this->belongsTo(Country::class); }
    public function cities(){ return $this->hasMany(LocationCity::class); }
    public function getRouteKeyName(){ return 'slug'; }
}
