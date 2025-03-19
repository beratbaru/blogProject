<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function getPolicies($type)
    {
        $response = Http::withHeaders(['Authorization' => session('api_token')])
            ->get(env('API_URL') . "/api/policies/{$type}"); 
    
        if ($response->successful()) {
            $policy = $response->json();

            return view("policy.show", [
                'title' => $policy['title'] ?? 'Unknown Policy',
                'content' => $policy['content'] ?? '',
            ]);
        }
        dd($response->json());
        return view("policy.show")->with('error', 'Could not fetch the policy.');
    }
}
