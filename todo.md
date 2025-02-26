To Do List:

<!-- 1. vendor node_modules gibi klasörlerdeki kodların kaldırılması gerekiyor. bunların repo'ya yollanmaması gerekiyor.
2. mysql_data'nında yollanmaması lazım. -->
3. request validation kullanılacak.
<!-- 4. 'berat123@gmail.com' bu tarz statik şeyler olmamalı. env üzerinden config'den alınmalı. -->
5. policies tek key ile tek satır policy gelmeli.
6. api'deki response yapısının düzenlenmesi gerekiyor. bunun için bir response class'ı oluşturulabilir.
7. kategori verileri db'den fe'den direk alınıyor.
8. 
Http::withHeaders(['Authorization' => session('api_token')])
->post(env('API_URL') . "/api/posts/{$postId}/comments", $request->all());
bu kod çok tekrar ediliyor. bunun yerine bir fonksiyon yazılabilir.
<!-- 9. bir çok gereksiz yorum satırları bulunuyor. bunlar kaldırılmalı. (done)
10. http://api_nginx/api/login -> api_nginx env üzerinden config'den belirtilen değer gelmeli. -->