<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class currentWeatherTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_check_get_openweather()
    {
        $response = $this->get('/current_weather?city=London');

        $response->assertStatus(200);

        $response->assertJson(fn (AssertableJson $json) =>
            $json->hasAll('weather','main','timezone','name')->etc()
        );

        
    }
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_check_return_openweather_city_null(){
        $response = $this->withoutExceptionHandling()->get('/current_weather?city=null');
        $response->assertJson(fn (AssertableJson $json) =>
            $json->where('message','city not found')->etc()
        );
    }

    
}
