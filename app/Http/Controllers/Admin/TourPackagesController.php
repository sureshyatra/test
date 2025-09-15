<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocationContentRequest;
use App\Models\Country;
use App\Models\State;
use App\Models\LocationCity;
use App\Models\TourPackages;
use Illuminate\Validation\ValidationException;

class TourPackagesController extends Controller {
    public function index(){
        $items = TourPackages::orderBy('id','desc')->paginate(25);
        return view('admin.content.index', ['items'=>$items,'title'=>'TourPackages','routeBase'=>'admin.location_tour_packages']);
    }
    public function create(){
        $countries = Country::orderBy('name')->get();
        $states    = State::orderBy('name')->get();
        $cities    = LocationCity::orderBy('name')->get();
        return view('admin.content.create', ['countries'=>$countries,'states'=>$states,'cities'=>$cities,'title'=>'TourPackages','routeBase'=>'admin.location_tour_packages']);
    }
    public function store(StoreLocationContentRequest $request){
        $data = $request->validated();
        $exists = TourPackages::where('location_type',$data['location_type'])->where('location_id',$data['location_id'])->exists();
        if ($exists) throw ValidationException::withMessages(['location_id'=>'This TourPackages already exists for the selected location.']);
        TourPackages::create($data);
        return redirect()->route('admin.location_tour_packages.index')->with('success','TourPackages created.');
    }
    public function edit(TourPackages $item){
        $countries = Country::orderBy('name')->get();
        $states    = State::orderBy('name')->get();
        $cities    = LocationCity::orderBy('name')->get();
        return view('admin.content.edit', ['item'=>$item,'countries'=>$countries,'states'=>$states,'cities'=>$cities,'title'=>'TourPackages','routeBase'=>'admin.location_tour_packages']);
    }
    public function update(StoreLocationContentRequest $request, TourPackages $item){
        $data = $request->validated();
        $exists = TourPackages::where('location_type',$data['location_type'])->where('location_id',$data['location_id'])->where('id','!=',$item->id)->exists();
        if ($exists) throw ValidationException::withMessages(['location_id'=>'This TourPackages already exists for the selected location.']);
        $item->update($data);
        return redirect()->route('admin.location_tour_packages.index')->with('success','TourPackages updated.');
    }
    public function destroy(TourPackages $item){
        $item->delete();
        return back()->with('success','TourPackages deleted.');
    }
}
