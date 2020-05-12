<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\User;
use Config;

class FourSquareController extends Controller
{
    //

    public function index($q) {
        $url = Config::get('api.foursquare_api_url').'/search';

        $response = HTTP::get($url, [
            'v' => '20200501',
            'near' => 'Tokyo,JP',
            'limit' => 10,
            'client_id' => Config::get('api.foursquare_client_id'),
            'client_secret' => Config::get('api.foursquare_client_secret'),
        ]);

        return $response->json();
    }

    public function photos($id) {
        $url = Config::get('api.foursquare_api_url').$id.'/photos';

        $response = HTTP::get($url, [
            'v' => '20200501',
            'limit' => 10,
            'client_id' => Config::get('api.foursquare_client_id'),
            'client_secret' => Config::get('api.foursquare_client_secret'),
        ]);

        return $response->json();
    }
}
