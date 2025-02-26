<!doctype html>
<html lang="{{ str_replace('_', '-',  app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Post</title>
    @vite('resources/css/app.css')
    
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="flex flex-col min-h-screen" style="overflow-x:hidden;">
    <div class="flex-grow">
        @yield('content')
    </div>

    <footer class="bg-gray-800 text-white py-6 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="flex justify-center space-x-8">
                <a href="{{ route('policy.kvkk') }}" 
                   class="text-gray-400 hover:text-white transition-colors">
                    KVKK Politikası
                </a>
                <a href="{{ route('policy.policy') }}" 
                   class="text-gray-400 hover:text-white transition-colors">
                    Güvenlik Politikası
                </a>
            </div>
            <div class="mt-4 text-sm text-gray-400">
                &copy; {{ date('Y') }} Tüm hakları saklıdır.
            </div>
        </div>
    </footer>
</body>
</html>
