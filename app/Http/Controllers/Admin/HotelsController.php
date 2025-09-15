<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocationContentRequest;
use App\Models\Country;
use App\Models\State;
use App\Models\LocationCity;
use App\Models\Hotels;
use Illuminate\Validation\ValidationException;

class HotelsController extends Controller {
    public function index(){
        $items = Hotels::orderBy('id','desc')->paginate(25);
        return view('admin.content.index', ['items'=>$items,'title'=>'Hotels','routeBase'=>'admin.location_hotels']);
    }
    public function create(){
        $countries = Country::orderBy('name')->get();
        $states    = State::orderBy('name')->get();
        $cities    = LocationCity::orderBy('name')->get();
        return view('admin.content.create', ['countries'=>$countries,'states'=>$states,'cities'=>$cities,'title'=>'Hotels','routeBase'=>'admin.location_hotels']);
    }
    public function store(StoreLocationContentRequest $request){
        $data = $request->validated();
        $exists = Hotels::where('location_type',$data['location_type'])->where('location_id',$data['location_id'])->exists();
        if ($exists) throw ValidationException::withMessages(['location_id'=>'This Hotels already exists for the selected location.']);
        Hotels::create($data);
        return redirect()->route('admin.location_hotels.index')->with('success','Hotels created.');
    }
    public function edit(Hotels $item){
        $countries = Country::orderBy('name')->get();
        $states    = State::orderBy('name')->get();
        $cities    = LocationCity::orderBy('name')->get();
        return view('admin.content.edit', ['item'=>$item,'countries'=>$countries,'states'=>$states,'cities'=>$cities,'title'=>'Hotels','routeBase'=>'admin.location_hotels']);
    }
    public function update(StoreLocationContentRequest $request, Hotels $item){
        $data = $request->validated();
        $exists = Hotels::where('location_type',$data['location_type'])->where('location_id',$data['location_id'])->where('id','!=',$item->id)->exists();
        if ($exists) throw ValidationException::withMessages(['location_id'=>'This Hotels already exists for the selected location.']);
        $item->update($data);
        return redirect()->route('admin.location_hotels.index')->with('success','Hotels updated.');
    }
    public function destroy(Hotels $item){
        $item->delete();
        return back()->with('success','Hotels deleted.');
    }
}
