<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Country extends Model {
    protected $fillable = ['name','slug','iso2','meta'];
    protected $casts = ['meta' => 'array'];
    public function states(){ return $this->hasMany(State::class); }
    public function cities(){ return $this->hasMany(LocationCity::class); }
    public function getRouteKeyName(){ return 'slug'; }
}
