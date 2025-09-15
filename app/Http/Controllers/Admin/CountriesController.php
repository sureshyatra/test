<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCountryRequest;
use App\Models\Country;

class CountriesController extends Controller {
    public function index(){
        $items = Country::orderBy('name')->paginate(25);
        return view('admin.masters.countries.index', compact('items'));
    }
    public function create(){
        return view('admin.masters.countries.create');
    }
    public function store(StoreCountryRequest $request){
        Country::create($request->validated());
        return redirect()->route('admin.countries.index')->with('success','Country created.');
    }
    public function edit(Country $country){
        return view('admin.masters.countries.edit', compact('country'));
    }
    public function update(StoreCountryRequest $request, Country $country){
        $country->update($request->validated());
        return redirect()->route('admin.countries.index')->with('success','Country updated.');
    }
    public function destroy(Country $country){
        $country->delete();
        return back()->with('success','Country deleted.');
    }
}
