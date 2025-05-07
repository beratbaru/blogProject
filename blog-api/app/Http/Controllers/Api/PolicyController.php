<?php

namespace App\Http\Controllers\Api;

use App\Models\Policy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;

class PolicyController extends Controller
{
    public function getPolicies($type, ApiResponse $errors)
    {
        $policy = Policy::where('title', $type)->first();
    
        if (!$policy) {
            return ApiResponse::error('such policy does not exist',404);
        }
    
        return ApiResponse::success([
            'title' => $policy['title'],
            'content' => $policy['content']
        ]);
    }
    
}

