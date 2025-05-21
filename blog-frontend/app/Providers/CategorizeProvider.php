<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Helpers\ApiRequest;

class CategorizeProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        try {
            $categories = ApiRequest::request('get', '/api/categories')->json('data');
            $tags = ApiRequest::request('get', '/api/tags')->json('data');
        } catch (\Exception $e) { //added this to prevent the api from crashing just in case
            $categories = [];
            $tags = [];
            
        }

        View::share([
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }
}
