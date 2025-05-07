<!doctype html>
<html lang="<?php echo e(str_replace('_', '-',  app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Blog</title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="flex flex-col min-h-screen" style="overflow-x:hidden;">
    <div class="flex-grow">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <footer class="bg-gray-800 text-white py-6 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="flex justify-center space-x-8">
                <a href="<?php echo e(route('policy', ['type' => 'kvkk'])); ?>" 
 
                   class="text-gray-400 hover:text-white transition-colors">
                    KVKK Politikası
                </a>
                <a href="<?php echo e(route('policy', ['type' => 'security'])); ?>" 
                   class="text-gray-400 hover:text-white transition-colors">
                    Güvenlik Politikası
                </a>
            </div>
            <div class="mt-4 text-sm text-gray-400">
                &copy; <?php echo e(date('Y')); ?> Tüm hakları saklıdır.
            </div>
        </div>
    </footer>
</body>
</html>
<?php /**PATH /var/www/html/resources/views/layouts/frontend.blade.php ENDPATH**/ ?>