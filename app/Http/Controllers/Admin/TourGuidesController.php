<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocationContentRequest;
use App\Models\Country;
use App\Models\State;
use App\Models\LocationCity;
use App\Models\TourGuides;
use Illuminate\Validation\ValidationException;

class TourGuidesController extends Controller {
    public function index(){
        $items = TourGuides::orderBy('id','desc')->paginate(25);
        return view('admin.content.index', ['items'=>$items,'title'=>'TourGuides','routeBase'=>'admin.location_tour_guides']);
    }
    public function create(){
        $countries = Country::orderBy('name')->get();
        $states    = State::orderBy('name')->get();
        $cities    = LocationCity::orderBy('name')->get();
        return view('admin.content.create', ['countries'=>$countries,'states'=>$states,'cities'=>$cities,'title'=>'TourGuides','routeBase'=>'admin.location_tour_guides']);
    }
    public function store(StoreLocationContentRequest $request){
        $data = $request->validated();
        $exists = TourGuides::where('location_type',$data['location_type'])->where('location_id',$data['location_id'])->exists();
        if ($exists) throw ValidationException::withMessages(['location_id'=>'This TourGuides already exists for the selected location.']);
        TourGuides::create($data);
        return redirect()->route('admin.location_tour_guides.index')->with('success','TourGuides created.');
    }
    public function edit(TourGuides $item){
        $countries = Country::orderBy('name')->get();
        $states    = State::orderBy('name')->get();
        $cities    = LocationCity::orderBy('name')->get();
        return view('admin.content.edit', ['item'=>$item,'countries'=>$countries,'states'=>$states,'cities'=>$cities,'title'=>'TourGuides','routeBase'=>'admin.location_tour_guides']);
    }
    public function update(StoreLocationContentRequest $request, TourGuides $item){
        $data = $request->validated();
        $exists = TourGuides::where('location_type',$data['location_type'])->where('location_id',$data['location_id'])->where('id','!=',$item->id)->exists();
        if ($exists) throw ValidationException::withMessages(['location_id'=>'This TourGuides already exists for the selected location.']);
        $item->update($data);
        return redirect()->route('admin.location_tour_guides.index')->with('success','TourGuides updated.');
    }
    public function destroy(TourGuides $item){
        $item->delete();
        return back()->with('success','TourGuides deleted.');
    }
}
