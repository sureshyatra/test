<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocationContentRequest;
use App\Models\Country;
use App\Models\State;
use App\Models\LocationCity;
use App\Models\PlacesToVisit;
use Illuminate\Validation\ValidationException;

class PlacesToVisitController extends Controller {
    public function index(){
        $items = PlacesToVisit::orderBy('id','desc')->paginate(25);
        return view('admin.content.index', ['items'=>$items,'title'=>'PlacesToVisit','routeBase'=>'admin.location_places_to_visit']);
    }
    public function create(){
        $countries = Country::orderBy('name')->get();
        $states    = State::orderBy('name')->get();
        $cities    = LocationCity::orderBy('name')->get();
        return view('admin.content.create', ['countries'=>$countries,'states'=>$states,'cities'=>$cities,'title'=>'PlacesToVisit','routeBase'=>'admin.location_places_to_visit']);
    }
    public function store(StoreLocationContentRequest $request){
        $data = $request->validated();
        $exists = PlacesToVisit::where('location_type',$data['location_type'])->where('location_id',$data['location_id'])->exists();
        if ($exists) throw ValidationException::withMessages(['location_id'=>'This PlacesToVisit already exists for the selected location.']);
        PlacesToVisit::create($data);
        return redirect()->route('admin.location_places_to_visit.index')->with('success','PlacesToVisit created.');
    }
    public function edit(PlacesToVisit $item){
        $countries = Country::orderBy('name')->get();
        $states    = State::orderBy('name')->get();
        $cities    = LocationCity::orderBy('name')->get();
        return view('admin.content.edit', ['item'=>$item,'countries'=>$countries,'states'=>$states,'cities'=>$cities,'title'=>'PlacesToVisit','routeBase'=>'admin.location_places_to_visit']);
    }
    public function update(StoreLocationContentRequest $request, PlacesToVisit $item){
        $data = $request->validated();
        $exists = PlacesToVisit::where('location_type',$data['location_type'])->where('location_id',$data['location_id'])->where('id','!=',$item->id)->exists();
        if ($exists) throw ValidationException::withMessages(['location_id'=>'This PlacesToVisit already exists for the selected location.']);
        $item->update($data);
        return redirect()->route('admin.location_places_to_visit.index')->with('success','PlacesToVisit updated.');
    }
    public function destroy(PlacesToVisit $item){
        $item->delete();
        return back()->with('success','PlacesToVisit deleted.');
    }
}
