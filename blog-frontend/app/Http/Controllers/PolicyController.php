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
    
        $responseData = $response->json();

        if ($response->successful()) {
            $policy = $responseData['data'];

            return view("policy.show", [
                'title' => $policy['title'] ?? 'Unknown Policy',
                'content' => $policy['content'] ?? '',
            ]);
        }

        return view("policy.show")->with('error', 'Could not fetch the policy.');
    }
}
