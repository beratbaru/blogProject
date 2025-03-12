<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Validator;
class ProfileController extends Controller
{
    public function index()
    {
        //
    }

    public function update(UpdateProfileRequest $request)
    {
        $profile = $request->user();
    
        if (!$profile) {
            return response()->json(['message' => 'Kullanıcı bulunamadı.'], 404);
        }
    
        $validated = $request->validated();
    
        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }
    
        $profile->update($validated);
    
        return response()->json([
            'message' => 'Profiliniz başarıyla güncellendi.',
            'data' => $profile,
        ], 200);
    }
    

}
