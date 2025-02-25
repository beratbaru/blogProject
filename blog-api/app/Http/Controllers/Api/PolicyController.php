<?php

namespace App\Http\Controllers\Api;

use App\Models\Policy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class PolicyController extends Controller
{
    public function getPolicies()
    {
        $policy = Policy::first();

        if ($policy) {
            return response()->json([
                'kvkk_policy' => $policy->kvkk_policy,
                'security_policy' => $policy->security_policy,
            ]);
        }

        return response()->json(['error' => 'Policies not found.'], 404);
    }
}

