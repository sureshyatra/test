<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocationContentRequest;
use App\Models\Country;
use App\Models\State;
use App\Models\LocationCity;
use App\Models\ThingsToDo;
use Illuminate\Validation\ValidationException;

class ThingsToDoController extends Controller {
    public function index(){
        $items = ThingsToDo::orderBy('id','desc')->paginate(25);
        return view('admin.content.index', ['items'=>$items,'title'=>'ThingsToDo','routeBase'=>'admin.location_things_to_do']);
    }
    public function create(){
        $countries = Country::orderBy('name')->get();
        $states    = State::orderBy('name')->get();
        $cities    = LocationCity::orderBy('name')->get();
        return view('admin.content.create', ['countries'=>$countries,'states'=>$states,'cities'=>$cities,'title'=>'ThingsToDo','routeBase'=>'admin.location_things_to_do']);
    }
    public function store(StoreLocationContentRequest $request){
        $data = $request->validated();
        $exists = ThingsToDo::where('location_type',$data['location_type'])->where('location_id',$data['location_id'])->exists();
        if ($exists) throw ValidationException::withMessages(['location_id'=>'This ThingsToDo already exists for the selected location.']);
        ThingsToDo::create($data);
        return redirect()->route('admin.location_things_to_do.index')->with('success','ThingsToDo created.');
    }
    public function edit(ThingsToDo $item){
        $countries = Country::orderBy('name')->get();
        $states    = State::orderBy('name')->get();
        $cities    = LocationCity::orderBy('name')->get();
        return view('admin.content.edit', ['item'=>$item,'countries'=>$countries,'states'=>$states,'cities'=>$cities,'title'=>'ThingsToDo','routeBase'=>'admin.location_things_to_do']);
    }
    public function update(StoreLocationContentRequest $request, ThingsToDo $item){
        $data = $request->validated();
        $exists = ThingsToDo::where('location_type',$data['location_type'])->where('location_id',$data['location_id'])->where('id','!=',$item->id)->exists();
        if ($exists) throw ValidationException::withMessages(['location_id'=>'This ThingsToDo already exists for the selected location.']);
        $item->update($data);
        return redirect()->route('admin.location_things_to_do.index')->with('success','ThingsToDo updated.');
    }
    public function destroy(ThingsToDo $item){
        $item->delete();
        return back()->with('success','ThingsToDo deleted.');
    }
}
