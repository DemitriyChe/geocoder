<?php

namespace App\Http\Controllers;

use Geocoder\Query\GeocodeQuery;
use Geocoder\Query\ReverseQuery;
use Illuminate\Http\Request;

class GeoController extends Controller
{
    public function index(Request $request)
    {
        if (empty(env('YA_API_KEY'))) {
            throw new \Exception('YA_API_KEY not set');
        }

        $data = [];

        if (strlen($query = $request->input('query')) < 3) {
            return view('home', ['data' => $data, 'query' => $query]);
        }

        $resultsLimit = 5;
        $reverseResultsLimit = 1;
        $results = app('geocoder')->geocodeQuery(GeocodeQuery::create($query)->withLimit($resultsLimit))->all();

        foreach ($results as $result) {
            $coordinates = $result->getCoordinates();
            $metroData = app('geocoder')->reverseQuery(
                ReverseQuery::create($coordinates)->withLimit($reverseResultsLimit)->withData('toponym', 'metro')
            )->all();
            $districtData = app('geocoder')->reverseQuery(
                ReverseQuery::create($coordinates)->withLimit($reverseResultsLimit)->withData('toponym', 'district')
            )->all();

            $data[] = [
                'subLocality' => array_key_exists(0, $districtData) ? $districtData[0]->getName() ?? 'Не указано' : 'Не указано',
                'streetName' => $result->getStreetName() ?? 'Не указано',
                'streetNumber' => $result->getStreetNumber() ?? 'Не указано',
                'metroStation' => array_key_exists(0, $metroData) ? $metroData[0]->getName() ?? 'Не указано' : 'Не указано'
            ];
        }

        return view('home', ['data' => $data, 'query' => $query]);
    }
}

