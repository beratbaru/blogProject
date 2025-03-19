<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function getPolicies($type)
    {
        if ($type === 'kvkk'){
            $response = Http::withHeaders(['Authorization' => session('api_token')])
                ->get(env('API_URL') . "/api/policies/{$type}");

            if ($response->successful()) {
                $policies = $response->json();
                return view('policy.kvkk', [
                    'kvkk_policy' => $policies['kvkk_policy'] ?? '',
                ]);
            }

            return view('policy.kvkk')->with('error', 'Could not fetch KVKK policy.');
        } 
        elseif($type === 'security'){
            $response = Http::withHeaders(['Authorization' => session('api_token')])
                ->get(env('API_URL') . "/api/policies/{$type}");

            if ($response->successful()) {
                $policies = $response->json();
                return view('policy.security', [
                    'security_policy' => $policies['security_policy'] ?? '',
                ]);
                
            }

            return view('policy.security')->with('error', 'Could not fetch Security Policy.');
        }
    }


}
