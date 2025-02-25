<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function showKvkkPolicy()
    {
        $response = Http::withHeaders(['Authorization' => session('api_token')])
            ->get(env('API_URL') . "/api/policies");

        if ($response->successful()) {
            $policies = $response->json();
            return view('policy.kvkk', [
                'kvkk_policy' => $policies['kvkk_policy'] ?? '',
            ]);
        }

        return view('policy.kvkk')->with('error', 'Could not fetch KVKK policy.');
    }

    public function showSecurityPolicy()
    {
        $response = Http::withHeaders(['Authorization' => session('api_token')])
            ->get(env('API_URL') . "/api/policies");

        if ($response->successful()) {
            $policies = $response->json();
            return view('policy.policy', [
                'security_policy' => $policies['security_policy'] ?? '',
            ]);
        }

        return view('policy.policy')->with('error', 'Could not fetch Security policy.');
    }
}
