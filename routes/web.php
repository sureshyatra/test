<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Admin\LocationPageController;
use App\Http\Controllers\Admin\CountriesController;
use App\Http\Controllers\Admin\StatesController;
use App\Http\Controllers\Admin\LocationCitiesController;
use App\Http\Controllers\Admin\TourPackagesController;
use App\Http\Controllers\Admin\BestTimeToVisitController;
use App\Http\Controllers\Admin\HowToReachController;
use App\Http\Controllers\Admin\PlacesToVisitController;
use App\Http\Controllers\Admin\TravelAgenciesController;
use App\Http\Controllers\Admin\TourGuidesController;
use App\Http\Controllers\Admin\ThingsToDoController;
use App\Http\Controllers\Admin\TouristMapsController;
use App\Http\Controllers\Admin\HotelsController;

// Public
Route::prefix('country/{country:slug}')->group(function () {
    Route::get('/', [LocationController::class, 'country'])->name('country.show');
    Route::get('{page?}', [LocationController::class, 'country']);
});
Route::prefix('state/{state:slug}')->group(function () {
    Route::get('/', [LocationController::class, 'state'])->name('state.show');
    Route::get('{page?}', [LocationController::class, 'state']);
});
Route::prefix('city/{city:slug}')->group(function () {
    Route::get('/', [LocationController::class, 'city'])->name('city.show');
    Route::get('{page?}', [LocationController::class, 'city']);
});

// Admin
Route::prefix('admin')->group(function () {
    Route::get('location-pages', [LocationPageController::class, 'index'])->name('admin.location-pages.index');
    Route::get('location-pages/create', [LocationPageController::class, 'create'])->name('admin.location-pages.create');
    Route::post('location-pages', [LocationPageController::class, 'store'])->name('admin.location-pages.store');
    Route::get('location-pages/{locationPage}/edit', [LocationPageController::class, 'edit'])->name('admin.location-pages.edit');
    Route::put('location-pages/{locationPage}', [LocationPageController::class, 'update'])->name('admin.location-pages.update');
    Route::delete('location-pages/{locationPage}', [LocationPageController::class, 'destroy'])->name('admin.location-pages.destroy');

    Route::resource('countries', CountriesController::class)->names('admin.countries');
    Route::resource('states', StatesController::class)->names('admin.states');
    Route::resource('cities', LocationCitiesController::class)->names('admin.cities');

    Route::resource('tour-packages', TourPackagesController::class)->parameters(['tour-packages'=>'item'])->names('admin.location_tour_packages');
    Route::resource('best-time-to-visit', BestTimeToVisitController::class)->parameters(['best-time-to-visit'=>'item'])->names('admin.location_best_time_to_visit');
    Route::resource('how-to-reach', HowToReachController::class)->parameters(['how-to-reach'=>'item'])->names('admin.location_how_to_reach');
    Route::resource('places-to-visit', PlacesToVisitController::class)->parameters(['places-to-visit'=>'item'])->names('admin.location_places_to_visit');
    Route::resource('travel-agencies', TravelAgenciesController::class)->parameters(['travel-agencies'=>'item'])->names('admin.location_travel_agencies');
    Route::resource('tour-guides', TourGuidesController::class)->parameters(['tour-guides'=>'item'])->names('admin.location_tour_guides');
    Route::resource('things-to-do', ThingsToDoController::class)->parameters(['things-to-do'=>'item'])->names('admin.location_things_to_do');
    Route::resource('tourist-map', TouristMapsController::class)->parameters(['tourist-map'=>'item'])->names('admin.location_tourist_maps');
    Route::resource('hotels', HotelsController::class)->parameters(['hotels'=>'item'])->names('admin.location_hotels');

    // AJAX
    Route::get('ajax/states-by-country/{country}', [LocationCitiesController::class, 'statesByCountry'])->name('admin.ajax.states_by_country');
});
