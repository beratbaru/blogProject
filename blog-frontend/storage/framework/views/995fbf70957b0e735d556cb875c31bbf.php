<?php $__env->startSection('content'); ?>
<?php if(!session('api_token')): ?>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 flex items-center justify-center transition-colors duration-300">
        <div class="text-center bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl p-8 shadow-xl border border-gray-200 dark:border-gray-700">
            <h3 class="text-2xl font-light text-gray-800 dark:text-gray-100 mb-6">Lütfen önce giriş yapınız.</h3>
            <div class="flex justify-center gap-4">
                <a href="<?php echo e(route('register')); ?>" 
                class="px-6 py-2 bg-gradient-to-r from-amber-600 to-amber-500 text-white rounded-lg hover:from-amber-700 hover:to-amber-600 transition-all shadow-md hover:shadow-lg">
                    Kayıt Ol
                </a>
                <a href="<?php echo e(route('login')); ?>" 
                class="px-6 py-2 border-2 border-amber-500 text-amber-600 dark:text-amber-400 rounded-lg hover:bg-amber-500 hover:text-white transition-colors">
                    Giriş Yap
                </a>
            </div>
        </div>
    </div>
<?php else: ?>
<header class="sticky top-0 bg-white/80 dark:bg-gray-800/80 backdrop-blur-md border-b border-gray-200 dark:border-gray-700 z-50 transition-colors duration-300">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <a href="/posts" class="text-2xl font-light text-amber-600 dark:text-amber-400">Blog</a>
            
            <div class="hidden md:flex items-center space-x-6">
                <a href="<?php echo e(url('profile')); ?>" class="flex items-center text-gray-700 dark:text-gray-300 hover:text-amber-600 dark:hover:text-amber-400 transition-colors">
                    <i class="fas fa-user-circle text-xl mr-2"></i>
                    Profil
                </a>
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="flex items-center text-gray-700 dark:text-gray-300 hover:text-red-500 transition-colors">
                        <i class="fas fa-sign-out-alt text-xl mr-2"></i>
                        Çıkış Yap
                    </button>
                </form>
            </div>

            <button id="menuButton" class="md:hidden text-gray-700 dark:text-gray-300">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
    </nav>
</header>

<div id="menuDropdown" class="md:hidden absolute right-0 w-48 bg-white dark:bg-gray-700 shadow-xl rounded-lg py-2 mt-2 hidden border border-gray-200 dark:border-gray-600 z-50">
    <a href="<?php echo e(url('profile')); ?>" class="block px-6 py-3 hover:bg-gray-100 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300">
        <i class="fas fa-user-circle mr-3"></i>Profil
    </a>
    <form action="<?php echo e(route('logout')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <button type="submit" class="block w-full text-left px-6 py-3 hover:bg-gray-100 dark:hover:bg-gray-600 text-red-500">
            <i class="fas fa-sign-out-alt mr-3"></i>Çıkış yap
        </button>
    </form>
</div>

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 py-12 px-4 sm:px-6 lg:px-8 transition-colors duration-300">
    <div class="max-w-4xl mx-auto space-y-8">
        <?php if(session('success')): ?>
            <div class="bg-green-100 dark:bg-green-900/30 border-l-4 border-green-500 dark:border-green-600 text-green-800 dark:text-green-300 p-4 rounded-lg">
                <p class="font-bold">Başarılı!</p>
                <p><?php echo e(session('success')); ?></p>
            </div>
        <?php endif; ?>

        <article class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <div class="bg-gradient-to-r from-amber-800 to-amber-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-light text-white"><?php echo e($post['title']); ?></h1>
                    <a href="<?php echo e(route('post.index')); ?>" 
                       class="flex items-center text-white hover:text-gray-200 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i> Geri Dön
                    </a>
                </div>
            </div>

            <div class="px-6 py-8 space-y-6">
                <div class="prose max-w-none dark:prose-invert">
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed"><?php echo e($post['content']); ?></p>
                </div>
                <div class="rounded-xl overflow-hidden shadow-lg border border-gray-200 dark:border-gray-700">
                    <img src="<?php echo e('http://localhost:8000'.'/'.$post['image']); ?>" 
                         alt="Gönderi görseli" 
                         class="w-full h-96 object-cover transform hover:scale-105 transition-transform duration-300">
                </div>
            </div>
        </article>

        <section class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 border border-gray-200 dark:border-gray-700">
            <h2 class="text-2xl font-light text-gray-800 dark:text-gray-100 mb-6 flex items-center">
                <i class="fas fa-comments mr-3 text-amber-500"></i> Yorumlar (<?php echo e(count($comments)); ?>)
            </h2>

            <div class="space-y-6">
                <?php $__empty_1 = true; $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-5 shadow-sm hover:bg-gray-100 dark:hover:bg-gray-600/50 transition-colors">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-full bg-amber-500 text-white 
                                      flex items-center justify-center">
                                <?php echo e(strtoupper(substr($comment['user']['name'] ?? 'A', 0, 1))); ?>

                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <h3 class="font-medium text-gray-800 dark:text-gray-100">
                                    <?php echo e($comment['user']['name'] ?? 'Misafir Kullanıcı'); ?>

                                </h3>
                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                    <?php echo e(\Carbon\Carbon::parse($comment['created_at'])->diffForHumans()); ?>

                                </span>
                            </div>
                            <p class="mt-2 text-gray-600 dark:text-gray-300"><?php echo e($comment['content']); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="text-center py-6">
                    <p class="text-gray-500 dark:text-gray-400">Henüz yorum yok. İlk yorumu siz yapın!</p>
                </div>
                <?php endif; ?>
            </div>

            <form action="<?php echo e(route('comments.store', $postId)); ?>" method="POST" class="mt-8">
                <?php echo csrf_field(); ?>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Yorumunuz</label>
                        <textarea name="content" rows="3" 
                                  class="w-full rounded-lg bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 
                                         text-gray-800 dark:text-gray-300 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/50
                                         transition duration-200 p-3" 
                                  placeholder="Düşüncelerinizi paylaşın..." required></textarea>
                    </div>
                    <div class="text-right">
                        <button type="submit" 
                                class="inline-flex items-center bg-gradient-to-r from-amber-600 to-amber-500 
                                       text-white px-6 py-2 rounded-lg font-medium
                                       hover:from-amber-700 hover:to-amber-600 transition-all
                                       transform hover:scale-[1.02] shadow-md">
                            <i class="fas fa-paper-plane mr-2"></i> Yorum Gönder
                        </button>
                    </div>
                </div>
            </form>
            <?php if($errors->any()): ?>
                <div class="bg-red-100 dark:bg-red-900/30 border-l-4 border-red-500 dark:border-red-600 text-red-800 dark:text-red-300 p-4 rounded-lg">
                    <p class="font-bold">Hata!</p>
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
        </section>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuButton = document.getElementById('menuButton');
        const menuDropdown = document.getElementById('menuDropdown');

        menuButton.addEventListener('click', function() {
            menuDropdown.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!menuButton.contains(event.target) && !menuDropdown.contains(event.target)) {
                menuDropdown.classList.add('hidden');
            }
        });
    });
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/post/show.blade.php ENDPATH**/ ?>