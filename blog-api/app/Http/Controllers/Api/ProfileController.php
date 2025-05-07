<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Responses\ApiResponse;
use Illuminate\Support\Facades\Validator;
class ProfileController extends Controller
{
    public function update(UpdateProfileRequest $request)
    {
        $profile = $request->user();
    
        if (!$profile) {
            return response()->json(['message' => 'User not found.'], 404);
        }
    
        $validated = $request->validated();
    
        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }
    
        $profile->update($validated);
    
        return ApiResponse::success($profile, 'Profile updated successfully.', 200);
    }
}
