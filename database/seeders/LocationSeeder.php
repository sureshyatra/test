<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\State;
use App\Models\LocationCity;
use App\Models\LocationPage;
use App\Models\TourPackages;
use App\Models\BestTimeToVisit;
use App\Models\HowToReach;
use App\Models\PlacesToVisit;
use App\Models\TravelAgencies;
use App\Models\TourGuides;
use App\Models\ThingsToDo;
use App\Models\TouristMaps;
use App\Models\Hotels;
use Illuminate\Support\Carbon;

class LocationSeeder extends Seeder {
    public function run(): void {
        $india = Country::firstOrCreate(['slug'=>'india'], ['name'=>'India','iso2'=>'IN']);
        $rajasthan = State::firstOrCreate(['country_id'=>$india->id,'slug'=>'rajasthan'], ['name'=>'Rajasthan']);
        $jaipur = LocationCity::firstOrCreate(['country_id'=>$india->id,'state_id'=>$rajasthan->id,'slug'=>'jaipur'], ['name'=>'Jaipur']);

        $usa = Country::firstOrCreate(['slug'=>'united-states'], ['name'=>'United States','iso2'=>'US']);
        $california = State::firstOrCreate(['country_id'=>$usa->id,'slug'=>'california'], ['name'=>'California']);
        $la = LocationCity::firstOrCreate(['country_id'=>$usa->id,'state_id'=>$california->id,'slug'=>'los-angeles'], ['name'=>'Los Angeles']);

        LocationPage::firstOrCreate(
            ['location_type'=>'country','location_id'=>$india->id,'page_key'=>'overview'],
            ['title'=>'India Overview','content'=>'<p>Welcome to India.</p>']
        );
        LocationPage::firstOrCreate(
            ['location_type'=>'city','location_id'=>$jaipur->id,'page_key'=>'overview'],
            ['title'=>'Jaipur Overview','content'=>'<p>Jaipur — Pink City.</p>']
        );

        // Subpage entries for Jaipur
        TourPackages::firstOrCreate(['location_type'=>'city','location_id'=>$jaipur->id], ['title'=>'Jaipur Heritage Tour','content'=>'<p>2 days tour...</p>','published_at'=>Carbon::now()]);
        BestTimeToVisit::firstOrCreate(['location_type'=>'city','location_id'=>$jaipur->id], ['title'=>'Best Time','content'=>'<p>Oct-Mar.</p>','published_at'=>Carbon::now()]);
        HowToReach::firstOrCreate(['location_type'=>'city','location_id'=>$jaipur->id], ['title'=>'How to Reach','content'=>'<p>By Air/Road/Rail.</p>','published_at'=>Carbon::now()]);
        PlacesToVisit::firstOrCreate(['location_type'=>'city','location_id'=>$jaipur->id], ['title'=>'Places','content'=>'<p>Hawa Mahal...</p>','published_at'=>Carbon::now()]);
        TravelAgencies::firstOrCreate(['location_type'=>'city','location_id'=>$jaipur->id], ['title'=>'Agencies','content'=>'<p>Agency list</p>','published_at'=>Carbon::now()]);
        TourGuides::firstOrCreate(['location_type'=>'city','location_id'=>$jaipur->id], ['title'=>'Guides','content'=>'<p>Guide list</p>','published_at'=>Carbon::now()]);
        ThingsToDo::firstOrCreate(['location_type'=>'city','location_id'=>$jaipur->id], ['title'=>'Things to do','content'=>'<p>Shopping, food</p>','published_at'=>Carbon::now()]);
        TouristMaps::firstOrCreate(['location_type'=>'city','location_id'=>$jaipur->id], ['title'=>'Map','content'=>'<p>Map content</p>','published_at'=>Carbon::now()]);
        Hotels::firstOrCreate(['location_type'=>'city','location_id'=>$jaipur->id], ['title'=>'Hotels','content'=>'<p>Hotel list</p>','published_at'=>Carbon::now()]);
    }
}
