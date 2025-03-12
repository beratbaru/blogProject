<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class ApiRequest
{
    public static function request($method, $url, $data = [])
    {
        $response = Http::withHeaders([
            'Authorization' => session('api_token'),
            'Accept' => 'application/json'
        ])->{$method}(env('API_URL') . $url, $data);

        return $response;
    }
}
