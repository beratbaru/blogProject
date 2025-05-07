<?php $__env->startSection('content'); ?>
    <header class="sticky top-0 bg-gray-800/80 backdrop-blur-md border-b border-gray-700 z-50">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="<?php echo e(url('/posts')); ?>" class="text-2xl font-bold text-blue-400">Blog</a>
                
                <div class="hidden md:flex items-center space-x-6">
                    <a href="<?php echo e(url('profile')); ?>" class="flex items-center text-gray-300 hover:text-blue-400 transition-colors">
                        <i class="fas fa-user-circle text-xl mr-2"></i>
                        Profil
                    </a>
                    <form action="<?php echo e(route('logout')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="flex items-center text-gray-300 hover:text-red-400 transition-colors">
                            <i class="fas fa-sign-out-alt text-xl mr-2"></i>
                            Çıkış Yap
                        </button>
                    </form>
                </div>

                <button id="menuButton" class="md:hidden text-gray-300">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>


            <div id="mobileMenu" class="md:hidden hidden mt-4 bg-gray-800 rounded-lg p-4">
                <a href="<?php echo e(url('profile')); ?>" class="block py-2 text-gray-300 hover:text-blue-400 transition-colors">
                    <i class="fas fa-user-circle text-xl mr-2"></i>
                    Profil
                </a>
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="block py-2 text-gray-300 hover:text-red-400 transition-colors">
                        <i class="fas fa-sign-out-alt text-xl mr-2"></i>
                        Çıkış Yap
                    </button>
                </form>
            </div>
        </nav>
    </header>

    <div class="container mx-auto p-6">
        <div class="policy-section">

            <h2 class="text-2xl font-semibold text-gray-800 mb-4"><?php echo e($title ?? 'Böyle bir politika mevcut değil'); ?></h2>
        
        <?php if(session('error')): ?>
            <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
        <?php else: ?>

            <div class="policy-content bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <p class="text-gray-700 leading-relaxed"><?php echo e($content ?? 'Lütfen geçerli bir urlye geçiş yapınız.'); ?></p>
            </div>
        </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/policy/show.blade.php ENDPATH**/ ?>