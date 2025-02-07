projeyi kendi bilgisayarına kopyala:
    docker containerlarını başlat
    migrasyonları ve npm'i başlat
schedule işlemlerini test etmek için:
    1- terminale(blog-api'nin içinde) 'php artisan tinker' yaz
    2- terminale \Artisan::call('posts:update-status'); komutunu yapıştır
    3- tarihi gelmiş yazılar sitede paylaşılmış mı diye kontrol et
queue:
    oluşturduğun posta yorum gönder ve localhost:8000/horizon'dan queueya düşüp düşmediğini kontrol et