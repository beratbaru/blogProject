<?php $__env->startSection('content'); ?>
<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800">
    <div class="bg-white dark:bg-gray-800/95 rounded-xl shadow-lg p-8 w-full max-w-md border border-gray-200 dark:border-gray-700 transition-colors duration-300">
        <form action="<?php echo e(route('login')); ?>" method="POST" class="space-y-6">
            <?php echo csrf_field(); ?>
            <div class="text-center">
                <h3 class="text-3xl font-light text-gray-800 dark:text-gray-100 mb-2">Giriş Yap</h3>
                <p class="text-gray-500 dark:text-gray-400">Hesabınıza erişin</p>
            </div>

            <?php if($errors->any()): ?>
                <div class="bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-300 p-4 rounded-lg text-sm border border-red-100 dark:border-red-800">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p><?php echo e($error); ?></p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <div class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">E-posta</label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           required
                           placeholder="E-postanızı girin" 
                           value="<?php echo e(old('email')); ?>" 
                           class="w-full px-4 py-3 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Şifre</label>
                    <input type="password" 
                           name="password" 
                           id="password" 
                           required
                           placeholder="Şifrenizi girin" 
                           class="w-full px-4 py-3 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
                </div>
            </div>
            <div class="pt-2">
                <button type="submit" 
                        class="w-full px-6 py-3 bg-amber-600 hover:bg-amber-700 text-white font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 shadow-md hover:shadow-lg transition-all duration-300">
                    Giriş Yap
                </button>
            </div>

            <p class="text-center text-sm text-gray-500 dark:text-gray-400">
                Hesabınız yok mu? 
                <a href="<?php echo e(route('register')); ?>" class="text-amber-600 dark:text-amber-400 hover:text-amber-700 dark:hover:text-amber-300 font-medium transition-colors">Kayıt Ol</a>
            </p>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/login.blade.php ENDPATH**/ ?>