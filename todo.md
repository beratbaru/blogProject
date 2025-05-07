To Do List:

<!-- 1. vendor node_modules gibi klasörlerdeki kodların kaldırılması gerekiyor. bunların repo'ya yollanmaması gerekiyor.//ok
2. mysql_data'nında yollanmaması lazım. //ok
3. request validation kullanılacak. //ok
4. 'berat123@gmail.com' bu tarz statik şeyler olmamalı. env üzerinden config'den alınmalı. //done using packages
5. policies tek key ile tek satır policy gelmeli. //ok-->
<!-- 6. api'deki response yapısının düzenlenmesi gerekiyor. bunun için bir response class'ı oluşturulabilir. //ok, might check later though
7. kategori verileri db'den fe'den direk alınıyor. ???
8. 
Http::withHeaders(['Authorization' => session('api_token')])
->post(env('API_URL') . "/api/posts/{$postId}/comments", $request->all());
bu kod çok tekrar ediliyor. bunun yerine bir fonksiyon yazılabilir.
 9. bir çok gereksiz yorum satırları bulunuyor. bunlar kaldırılmalı. //ok
10. http://api_nginx/api/login -> api_nginx env üzerinden config'den belirtilen değer gelmeli. //ok -->

Berat Baru:
Proje: https://github.com/beratbaru/blogProject/
Backend:

database bilgileri docker-compose.yml üzerinde tanımlanmış bunları envden çekilebilir.

projeyi kurduktan sonra içine girince var/www den başlıyor dockerfilede workdiri düzeltebilirmisin? (Aynısı Frontenddede var)

<!-- projeyi kurarken storage klasöründe framework klasörünü silmişsin bundan kaynaklı projeyi kurarken hata aldım. (Aynısı Frontenddede var) -->

projeyi kurduktan sonra migrate yaptım ama sessions tablosunu bulamadı silinmiş. php artisan make:session-table ile çözdüm istersen bunu readmede belirterek veyada direkt migration dosyasını ekleyerek çözebilirsin.

bir önceki revizelerdeki 6. maddedeki response yapısı hepsine uyarlanmamış. AuthControllerde, PolicyControllerde, ProfileControllerde.

AuthControllerde Loginde Validationu Requests kullanabilirsin.


Logout kodu çalışmıyor. Frontendde logout yapıyorum ama token silinmiyor. Postmande denedim hata aldım. "Call to undefined method App\\Models\\User::token()",

StoreCommentRequest contente required lazım


Frontend:
PolicyController dd kalmış. | Olmayan bir policies girince hata alıyorum.

Frontend logoutunda mesela backende göre işlem yapsan daha iyi olabilir eğer ki backend logout başarılı tokeni sildim derse sessiondan silersin tokeni. Backend Logout çalışmıyor.