<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocationPageRequest;
use App\Models\Country;
use App\Models\State;
use App\Models\LocationCity;
use App\Models\LocationPage;
use Illuminate\Validation\ValidationException;

class LocationPageController extends Controller {
    public function index(){
        $pages = LocationPage::orderBy('id','desc')->paginate(25);
        return view('admin.location_pages.index', compact('pages'));
    }
    public function create(){
        $countries = Country::orderBy('name')->get();
        $states    = State::orderBy('name')->get();
        $cities    = LocationCity::orderBy('name')->get();
        return view('admin.location_pages.create', compact('countries','states','cities'));
    }
    public function store(StoreLocationPageRequest $request){
        $data = $request->validated();
        $exists = LocationPage::where('location_type', $data['location_type'])
            ->where('location_id', $data['location_id'])
            ->where('page_key', $data['page_key'])->exists();
        if ($exists) throw ValidationException::withMessages(['page_key'=>'Overview already exists for this location.']);
        LocationPage::create($data);
        return redirect()->route('admin.location-pages.index')->with('success','Overview created.');
    }
    public function edit(LocationPage $locationPage){
        $countries = Country::orderBy('name')->get();
        $states    = State::orderBy('name')->get();
        $cities    = LocationCity::orderBy('name')->get();
        return view('admin.location_pages.edit', compact('locationPage','countries','states','cities'));
    }
    public function update(StoreLocationPageRequest $request, LocationPage $locationPage){
        $data = $request->validated();
        $exists = LocationPage::where('location_type',$data['location_type'])
            ->where('location_id',$data['location_id'])
            ->where('page_key',$data['page_key'])
            ->where('id','!=',$locationPage->id)->exists();
        if ($exists) throw ValidationException::withMessages(['page_key'=>'Overview already exists for this location.']);
        $locationPage->update($data);
        return redirect()->route('admin.location-pages.index')->with('success','Overview updated.');
    }
    public function destroy(LocationPage $locationPage){
        $locationPage->delete();
        return back()->with('success','Overview deleted.');
    }
}
