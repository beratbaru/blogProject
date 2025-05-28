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
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 transition-colors duration-300">
    <header class="sticky top-0 bg-white/80 dark:bg-gray-800/80 backdrop-blur-md border-b border-gray-200 dark:border-gray-700 z-50 transition-colors duration-300">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="#" class="text-2xl font-light text-amber-600 dark:text-amber-400">Blog</a>
                
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

            <div id="mobileMenu" class="md:hidden hidden mt-4 bg-white dark:bg-gray-700 rounded-lg p-4 shadow-lg border border-gray-200 dark:border-gray-600">
                <a href="<?php echo e(url('profile')); ?>" class="block py-2 text-gray-700 dark:text-gray-300 hover:text-amber-600 dark:hover:text-amber-400 transition-colors">
                    <i class="fas fa-user-circle text-xl mr-2"></i>
                    Profil
                </a>
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="block py-2 text-gray-700 dark:text-gray-300 hover:text-red-500 transition-colors">
                        <i class="fas fa-sign-out-alt text-xl mr-2"></i>
                        Çıkış Yap
                    </button>
                </form>
            </div>
        </nav>
    </header>

    <nav class="sticky top-16 bg-white/80 dark:bg-gray-800/80 backdrop-blur-md shadow-lg z-40 border-b border-gray-200 dark:border-gray-700 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex space-x-4">
            <form method="GET" class="flex space-x-4">
                <select name="category_id" onchange="this.form.submit()" class="px-4 py-2 rounded-lg text-sm font-medium bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                    <option value="">Tümü</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category['id']); ?>" <?php echo e(request('category_id') == $category['id'] ? 'selected' : ''); ?>>
                            <?php echo e($category['name']); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                <select name="tag" onchange="this.form.submit()" class="px-4 py-2 rounded-lg text-sm font-medium bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                    <option value="">Tüm Etiketler</option>
                    <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($tag['name']); ?>" <?php echo e(request('tag') == $tag['name'] ? 'selected' : ''); ?>>
                            <?php echo e($tag['name']); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <a href="<?php echo e(route('post.index')); ?>" class="px-4 py-2 bg-red-500 text-white rounded-lg text-sm font-medium hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                    Temizle
                </a>
            </form>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <?php if(session('status')): ?>
        <div class="mb-8 p-4 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400 rounded-lg border border-green-200 dark:border-green-800"><?php echo e(session('status')); ?></div>
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php $__empty_1 = true; $__currentLoopData = $posts['data']['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <article class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300 border border-gray-200 dark:border-gray-700">
                <div class="relative h-48 overflow-hidden">
                    <a href="<?php echo e(route('post.show', $post['id'])); ?>">
                        <img src="<?php echo e('http://localhost:8000'.'/'.$post['image']); ?>" 
                             alt="Post image" 
                             class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-300">
                    </a>
                </div>

                <div class="p-6">
                    <h3 class="text-xl font-light text-gray-800 dark:text-gray-100 mb-2"><?php echo e($post['title']); ?></h3>
                    <p class="text-gray-600 dark:text-gray-400 line-clamp-3 mb-4"><?php echo e($post['content']); ?></p>
                    <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400">
                        <span class="flex items-center">
                            <i class="fas fa-comment mr-2"></i>
                            <?php if($post['comments_count']>=1): ?>
                            <?php echo e($post['comments_count'] ?? 0); ?>

                            <?php endif; ?>
                        </span>
                    </div>
                </div>
            </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full text-center py-12">
                <div class="text-gray-500 dark:text-gray-400 text-xl mb-4">
                    <i class="fas fa-file-alt text-4xl mb-4"></i>
                    <p>Yazı bulunamadı. Hemen bir tane oluştur!</p>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php if(isset($paginationLinks) && isset($totalPosts) && $totalPosts > 6): ?>
        <div class="mt-12 flex justify-center space-x-4">
        <?php if(isset($paginationLinks[1]['url'])): ?>
            <a href="<?php echo e(url()->current() . '?' . parse_url($paginationLinks[1]['url'], PHP_URL_QUERY)); ?>" 
            class="px-5 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 flex items-center transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
            </a>
        <?php endif; ?>

        <?php if(isset($currentPage) && isset($totalPages)): ?>
            <div class="px-5 py-2 bg-amber-500 text-white rounded-lg">
                <?php echo e($currentPage); ?> / <?php echo e($totalPages); ?>

            </div>
        <?php endif; ?>

        <?php if(isset($paginationLinks[2]['url'])): ?>
            <a href="<?php echo e(url()->current() . '?' . parse_url($paginationLinks[2]['url'], PHP_URL_QUERY)); ?>" 
            class="px-5 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 flex items-center transition-colors">
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        <?php endif; ?>

        </div>
        <?php endif; ?>
    </main>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuButton = document.getElementById('menuButton');
        const mobileMenu = document.getElementById('mobileMenu');

        menuButton.addEventListener('click', function() {
            if (mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.remove('hidden');
            } else {
                mobileMenu.classList.add('hidden');
            }
        });

        document.addEventListener('click', function(event) {
            if (!menuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
                mobileMenu.classList.add('hidden');
            }
        });
    });
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/post/index.blade.php ENDPATH**/ ?>