<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCityRequest;
use App\Models\LocationCity;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class LocationCitiesController extends Controller {
    public function index(){
        $items = LocationCity::with('country','state')->orderBy('name')->paginate(25);
        return view('admin.masters.cities.index', compact('items'));
    }
    public function create(){
        $countries = Country::orderBy('name')->get();
        $states = State::orderBy('name')->get();
        return view('admin.masters.cities.create', compact('countries','states'));
    }
    public function store(StoreCityRequest $request){
        LocationCity::create($request->validated());
        return redirect()->route('admin.cities.index')->with('success','City created.');
    }
    public function edit(LocationCity $item){
        $countries = Country::orderBy('name')->get();
        $states = State::where('country_id', $item->country_id)->orderBy('name')->get();
        return view('admin.masters.cities.edit', compact('item','countries','states'));
    }
    public function update(StoreCityRequest $request, LocationCity $item){
        $item->update($request->validated());
        return redirect()->route('admin.cities.index')->with('success','City updated.');
    }
    public function destroy(LocationCity $item){
        $item->delete();
        return back()->with('success','City deleted.');
    }

    // AJAX helper
    public function statesByCountry(Request $request, $countryId){
        $states = State::where('country_id', $countryId)->orderBy('name')->get(['id','name']);
        return response()->json($states);
    }
}
