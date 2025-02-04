projeyi kendi bilgisayarına kopyala:
    1- terminale girip sırayla;
        cd blog-api, docker compose up --build -d, php artisan migrate,
        cd ..
        cd blog-frontend, docker compose up --build -d, npm run dev komutlarını çalıştır.
    2- admin paneline erişmek için: localhost:8000/panel urlsine giriş yap
    3- arayüze erişmek için localhost:8003/post urlsine giriş yap
schedule işlemlerini test etmek için:
    1- terminale 'php artisan tinker' yazarak tinker'a giriş yap.
    2- terminale '\Artisan::call('posts:update-status');' komutunu yapıştır.
    3- tarihi gelmiş yazılar sitede paylaşılmış mı diye kontrol et.

