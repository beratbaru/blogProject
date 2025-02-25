<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $profile = $request->user();
    
        if (!$profile) {
            return response()->json(['message' => 'Kullanıcı bulunamadı.'], 404);
        }
    
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $profile->id,
            'password' => 'sometimes|required|string|min:6',
        ]);
    
        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }
    
        $profile->update($validated);
    
        return response()->json([
            'message' => 'Profiliniz başarıyla güncellendi.',
            'data' => $profile,
        ], 200);
    }
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
