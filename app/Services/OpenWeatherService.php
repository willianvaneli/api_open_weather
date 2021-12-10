<?php

namespace App\Services;
use Illuminate\Support\Facades\Cache;

class OpenWeatherService 
{
    
    const BASE_URL = 'https://api.openweathermap.org/data/2.5/weather';
    
    /**
     * @param string $city
     */
    public function currentWeather($city){
        // VERIFICANDO INFORMAÇÃO EM CACHE
        $value = Cache::get($city);
        if($value){
            return $value;
        }

        // PARAMETROS ADICIONAIS - NÃO OBRIGATÓRIO - CONFIGURADO NO .ENV
        $params = [];
        $params['q'] = $city;
        $params['appid'] = config('openWeatherConfig.key', 'null');
        $params['units'] = config('openWeatherConfig.units', 'null');
        $params['lang'] = config('openWeatherConfig.lang', 'null');


        $url = self::BASE_URL.'?'.http_build_query($params);

        $curl = curl_init();

        curl_setopt_array($curl,[
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET'
        ]);

        // RESPOSTA
        $response = curl_exec($curl);

        curl_close($curl);
        
        if(json_decode($response)->cod = 200)
            Cache::put($city, $response, now()->addMinutes(20));
        
        return $response;
    }
}
