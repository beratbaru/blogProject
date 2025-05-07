<?php $__env->startSection('content'); ?>
<div class="flex items-center justify-center min-h-screen bg-gradient-to-r from-blue-50 to-purple-50">
    <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-md transform transition-all hover:scale-105">
        <form action="<?php echo e(route('login')); ?>" method="POST" class="space-y-6">
            <?php echo csrf_field(); ?>
            <h3 class="text-2xl font-bold text-gray-800 text-center mb-6">Giriş Yap</h3>

            <?php if($errors->any()): ?>
                <div class="bg-red-50 text-red-600 p-4 rounded-lg text-sm">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p><?php echo e($error); ?></p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">E-posta</label>
                <input type="email" 
                       name="email" 
                       id="email" 
                        
                       placeholder="E-postanızı girin" 
                       value="<?php echo e(old('email')); ?>" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Şifre</label>
                <input type="password" 
                       name="password" 
                       id="password" 
                        
                       placeholder="Şifrenizi girin" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
            </div>

            <div>
                <button type="submit" 
                        class="w-full px-4 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
                    Giriş Yap
                </button>
            </div>

            <p class="text-center text-gray-600 text-sm">
                Hesabınız yok mu? 
                <a href="<?php echo e(route('register')); ?>" class="text-blue-600 hover:underline">Kayıt Ol</a>
            </p>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/auth/login.blade.php ENDPATH**/ ?>