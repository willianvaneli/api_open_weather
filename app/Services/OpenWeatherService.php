<?php

namespace App\Services;

class OpenWeatherService 
{
    
    const BASE_URL = 'https://api.openweathermap.org/data/2.5/weather';
    
    /**
     * @param string $city
     */
    public function currentWeather($city){
        // PARAMETROS ADICIONAIS - NÃO OBRIGATÓRIO - CONFIGURADO NO .ENV
        $params = [];
        $params['q'] = $city;
        $params['appid'] = env('OPEN_WEATHER_KEY', 'null');
        $params['units'] = env('OPEN_WEATHER_UNITS', 'null');
        $params['lang'] = env('OPEN_WEATHER_LANG', 'null');
        

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

        return $response;
    }
}




?>