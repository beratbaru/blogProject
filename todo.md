To Do List:

<!-- 1. vendor node_modules gibi klasörlerdeki kodların kaldırılması gerekiyor. bunların repo'ya yollanmaması gerekiyor.//ok
2. mysql_data'nında yollanmaması lazım. //ok
3. request validation kullanılacak. //ok
4. 'berat123@gmail.com' bu tarz statik şeyler olmamalı. env üzerinden config'den alınmalı. //done using packages
5. policies tek key ile tek satır policy gelmeli. //ok-->
<!-- 6. api'deki response yapısının düzenlenmesi gerekiyor. bunun için bir response class'ı oluşturulabilir. //ok, might check later though-->
7. kategori verileri db'den fe'den direk alınıyor. ???
<!--8. 
Http::withHeaders(['Authorization' => session('api_token')])
->post(env('API_URL') . "/api/posts/{$postId}/comments", $request->all());
bu kod çok tekrar ediliyor. bunun yerine bir fonksiyon yazılabilir.
 9. bir çok gereksiz yorum satırları bulunuyor. bunlar kaldırılmalı. //ok
10. http://api_nginx/api/login -> api_nginx env üzerinden config'den belirtilen değer gelmeli. //ok -->