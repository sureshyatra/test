<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStateRequest;
use App\Models\State;
use App\Models\Country;

class StatesController extends Controller {
    public function index(){
        $items = State::with('country')->orderBy('name')->paginate(25);
        return view('admin.masters.states.index', compact('items'));
    }
    public function create(){
        $countries = Country::orderBy('name')->get();
        return view('admin.masters.states.create', compact('countries'));
    }
    public function store(StoreStateRequest $request){
        State::create($request->validated());
        return redirect()->route('admin.states.index')->with('success','State created.');
    }
    public function edit(State $state){
        $countries = Country::orderBy('name')->get();
        return view('admin.masters.states.edit', compact('state','countries'));
    }
    public function update(StoreStateRequest $request, State $state){
        $state->update($request->validated());
        return redirect()->route('admin.states.index')->with('success','State updated.');
    }
    public function destroy(State $state){
        $state->delete();
        return back()->with('success','State deleted.');
    }
}
