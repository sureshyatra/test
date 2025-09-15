<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\LocationCity;
use App\Models\LocationPage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LocationController extends Controller {
    private const PAGE_KEYS = [
        'overview','tour-packages','best-time-to-visit','how-to-reach',
        'places-to-visit','travel-agency','tour-guides','things-to-do',
        'tourist-map','hotels'
    ];

    public function country(Request $request, Country $country, ?string $page = null) {
        return $this->render('country', $country->id, $page, $country);
    }
    public function state(Request $request, State $state, ?string $page = null) {
        return $this->render('state', $state->id, $page, $state);
    }
    public function city(Request $request, LocationCity $city, ?string $page = null) {
        return $this->render('city', $city->id, $page, $city);
    }

    private function render(string $type, int $id, ?string $page, $record){
        $pageKey = $page ? $this->assertKey($page) : 'overview';
        $data = null;
        if ($pageKey === 'overview'){
            $data = LocationPage::where('location_type',$type)->where('location_id',$id)->first();
        } else {
            $data = null;
        }
        $viewScope = $type;
        $viewName = $pageKey === 'overview' ? 'show' : str_replace('-','_',$pageKey);
        $viewPath = "locations.$viewScope.$viewName";
        return view($viewPath, ['record'=>$record,'pageKey'=>$pageKey,'data'=>$data]);
    }

    private function assertKey(string $key): string {
        if (!in_array($key, self::PAGE_KEYS, true)) throw new NotFoundHttpException();
        return $key;
    }
}
