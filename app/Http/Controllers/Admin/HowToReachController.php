<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocationContentRequest;
use App\Models\Country;
use App\Models\State;
use App\Models\LocationCity;
use App\Models\HowToReach;
use Illuminate\Validation\ValidationException;

class HowToReachController extends Controller {
    public function index(){
        $items = HowToReach::orderBy('id','desc')->paginate(25);
        return view('admin.content.index', ['items'=>$items,'title'=>'HowToReach','routeBase'=>'admin.location_how_to_reach']);
    }
    public function create(){
        $countries = Country::orderBy('name')->get();
        $states    = State::orderBy('name')->get();
        $cities    = LocationCity::orderBy('name')->get();
        return view('admin.content.create', ['countries'=>$countries,'states'=>$states,'cities'=>$cities,'title'=>'HowToReach','routeBase'=>'admin.location_how_to_reach']);
    }
    public function store(StoreLocationContentRequest $request){
        $data = $request->validated();
        $exists = HowToReach::where('location_type',$data['location_type'])->where('location_id',$data['location_id'])->exists();
        if ($exists) throw ValidationException::withMessages(['location_id'=>'This HowToReach already exists for the selected location.']);
        HowToReach::create($data);
        return redirect()->route('admin.location_how_to_reach.index')->with('success','HowToReach created.');
    }
    public function edit(HowToReach $item){
        $countries = Country::orderBy('name')->get();
        $states    = State::orderBy('name')->get();
        $cities    = LocationCity::orderBy('name')->get();
        return view('admin.content.edit', ['item'=>$item,'countries'=>$countries,'states'=>$states,'cities'=>$cities,'title'=>'HowToReach','routeBase'=>'admin.location_how_to_reach']);
    }
    public function update(StoreLocationContentRequest $request, HowToReach $item){
        $data = $request->validated();
        $exists = HowToReach::where('location_type',$data['location_type'])->where('location_id',$data['location_id'])->where('id','!=',$item->id)->exists();
        if ($exists) throw ValidationException::withMessages(['location_id'=>'This HowToReach already exists for the selected location.']);
        $item->update($data);
        return redirect()->route('admin.location_how_to_reach.index')->with('success','HowToReach updated.');
    }
    public function destroy(HowToReach $item){
        $item->delete();
        return back()->with('success','HowToReach deleted.');
    }
}
