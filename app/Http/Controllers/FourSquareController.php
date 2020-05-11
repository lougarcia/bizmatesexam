<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Config;

class FourSquareController extends Controller
{
    //

    public function index($id) {
        echo $id;
        echo Config::get('api.foursquare_api_url');
        return $id;
    }
}
