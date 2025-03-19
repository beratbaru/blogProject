<?php

namespace App\Http\Controllers\Api;

use App\Models\Policy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class PolicyController extends Controller
{
    public function getPolicies($type)
    {
        $policy = Policy::where('title', $type)->first();
    
        if (!$policy) {
            return response()->json(['error' => 'Policy not found.'], 404);
        }
    
        return response()->json([
            'title' => $policy->title,
            'content' => $policy->content,
        ]);
    }
    
}

