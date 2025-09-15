<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocationContentRequest;
use App\Models\Country;
use App\Models\State;
use App\Models\LocationCity;
use App\Models\TouristMaps;
use Illuminate\Validation\ValidationException;

class TouristMapsController extends Controller {
    public function index(){
        $items = TouristMaps::orderBy('id','desc')->paginate(25);
        return view('admin.content.index', ['items'=>$items,'title'=>'TouristMaps','routeBase'=>'admin.location_tourist_maps']);
    }
    public function create(){
        $countries = Country::orderBy('name')->get();
        $states    = State::orderBy('name')->get();
        $cities    = LocationCity::orderBy('name')->get();
        return view('admin.content.create', ['countries'=>$countries,'states'=>$states,'cities'=>$cities,'title'=>'TouristMaps','routeBase'=>'admin.location_tourist_maps']);
    }
    public function store(StoreLocationContentRequest $request){
        $data = $request->validated();
        $exists = TouristMaps::where('location_type',$data['location_type'])->where('location_id',$data['location_id'])->exists();
        if ($exists) throw ValidationException::withMessages(['location_id'=>'This TouristMaps already exists for the selected location.']);
        TouristMaps::create($data);
        return redirect()->route('admin.location_tourist_maps.index')->with('success','TouristMaps created.');
    }
    public function edit(TouristMaps $item){
        $countries = Country::orderBy('name')->get();
        $states    = State::orderBy('name')->get();
        $cities    = LocationCity::orderBy('name')->get();
        return view('admin.content.edit', ['item'=>$item,'countries'=>$countries,'states'=>$states,'cities'=>$cities,'title'=>'TouristMaps','routeBase'=>'admin.location_tourist_maps']);
    }
    public function update(StoreLocationContentRequest $request, TouristMaps $item){
        $data = $request->validated();
        $exists = TouristMaps::where('location_type',$data['location_type'])->where('location_id',$data['location_id'])->where('id','!=',$item->id)->exists();
        if ($exists) throw ValidationException::withMessages(['location_id'=>'This TouristMaps already exists for the selected location.']);
        $item->update($data);
        return redirect()->route('admin.location_tourist_maps.index')->with('success','TouristMaps updated.');
    }
    public function destroy(TouristMaps $item){
        $item->delete();
        return back()->with('success','TouristMaps deleted.');
    }
}
