<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\User;
use Config;

class OpenWeatherMapController extends Controller
{
    //

    public function index($city, $country)
    {
        $url = Config::get('api.openweathermap_api_url');
        $appid = Config::get('api.openweathermap_api_key');

        // if(@fsockopen('google.com', 80))
        // {
        //     $response = Http::get($url.'?q='.$city.','.$country.'&appid='.$appid);
        //     return $response->json();
        // }

        // no connection, return dummy data
        return file_get_contents('dummy/'.strtolower($city).'.json');
    }
}
