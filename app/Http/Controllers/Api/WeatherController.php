<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('NotFirstTimeUser');
    }

    /**
     * Get weather data from API.
     *
     * @return array
     */
    public function index(): array
    {
        $weatherKey = config('services.openweather.key');
        $baseUrl = "https://api.openweathermap.org/data/2.5/onecall?&appid=$weatherKey&";
        $lat = request('lat');
        $lon = request('lon');
        $response = Http::get( $baseUrl . "lat=$lat&lon=$lon&exclude=minutely,hourly,alerts&units=imperial");
        return $response->json();
    }
}
