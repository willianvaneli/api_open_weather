<?php

namespace App\Http\Controllers;

use App\Services\OpenWeatherService;
use App\Http\Requests\OpenWeatherRequest;

class OpenWeatherController extends Controller
{
    //KEY DE ACESSO A API
    public function currentWeather(OpenWeatherRequest $request){
        
        $city = $request->query('city');
        if(isset($request["uf"]) && isset($request["country"])){
            $city = $city . ',' . $request["country"] . '-' . $request["uf"];
        }
        
        $openWeather = new OpenWeatherService();
        return $openWeather->currentWeather($city);
    }
}
