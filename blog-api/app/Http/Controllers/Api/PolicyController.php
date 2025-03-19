<?php

namespace App\Http\Controllers\Api;

use App\Models\Policy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class PolicyController extends Controller
{
    public function getPolicies($type)
    {
        $policy = Policy::first();
    
        if (!$policy) {
            return response()->json(['error' => 'Policies not found.'], 404);
        }
    
        if ($type === 'kvkk') {
            return response()->json(['kvkk_policy' => $policy->kvkk_policy]);
        }
    
        if ($type === 'security') {
            return response()->json(['security_policy' => $policy->security_policy]);
        }
    
        return response()->json(['error' => 'Invalid policy type.'], 400);
    }
}

