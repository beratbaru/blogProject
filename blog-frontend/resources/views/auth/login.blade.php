@extends('layouts.frontend')


<div class="flex items-center justify-center min-h-screen">
   <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-md">
      <form action="{{ route('login') }}" method="POST" class="space-y-4">
         @csrf
         <h3 class="text-xl font-semibold text-gray-700 text-center">GİRİŞ YAP</h3>

         <!-- Display success message -->
         @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-md">
               {{ session('success') }}
            </div>
         @endif

         <!-- Display validation or login errors -->
         @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-md">
               @foreach ($errors->all() as $error)
                  <p class="text-sm">{{ $error }}</p>
               @endforeach
            </div>
         @endif

         <div>
            <input type="email" 
                   name="email" 
                   required 
                   placeholder="mailinizi girin" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300">
         </div>

         <div>
            <input type="password" 
                   name="password" 
                   required 
                   placeholder="şifrenizi girin" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300">
         </div>

         <div>
            <input type="submit" 
                   name="submit" 
                   value="giriş yap" 
                   class="w-full px-4 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 cursor-pointer">
         </div>

         <p class="text-center text-gray-600">
            Hesabın yok mu? 
            <a href="{{ route('register') }}" class="text-blue-500 hover:underline">kayıt ol</a>
         </p>
      </form>
   </div>
</div>
