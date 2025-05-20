<?php

namespace App\Http\Controllers;

use App\Helpers\ApiRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function getPolicies($type)
    {
        $response = ApiRequest::request('get', "/api/policies/{$type}"); 
    
        if ($response->successful()) {
            $policy = $response->json('data');

            return view("policy.show", [
                'title' => $policy['title'] ?? 'Unknown Policy',
                'content' => $policy['content'] ?? '',
            ]);
        }

        return view("policy.show")->with('error', 'Could not fetch the policy.');
    }
}
