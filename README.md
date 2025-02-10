# Monitoring Polusi Udara

Proyek ini adalah aplikasi web untuk memantau polusi udara di Kota Makassar, khususnya di Jl. Andi Pangeran Pettarani, Gedung Pinisi UNM. Aplikasi ini menampilkan data polusi udara secara real-time, termasuk kadar gas asap (MQ-2) dan karbon monoksida (MQ-7).

## Fitur

- Menampilkan data polusi udara terbaru
- Menampilkan grafik data polusi udara
- Menampilkan peta lokasi
- Menampilkan peringatan polusi udara berdasarkan parameter PM2.5 dan PM10

## Instalasi

1. Clone repositori ini ke komputer Anda:

    ```sh
    git clone https://github.com/Aiakira99/repo-Sistem Monitoring Polusi Udara
    ```

2. Masuk ke direktori proyek:

    ```sh
    cd repo-Sistem Monitoring Polusi Udara 
    ```

3. Pastikan Anda memiliki server web seperti Apache atau Nginx yang terpasang di komputer Anda. Anda juga memerlukan PHP dan MySQL.

4. Buat database baru dan impor file `database.sql` yang disertakan dalam repositori ini.

5. Konfigurasi koneksi database di file `sensor.php`:

    ```php
    // filepath: /c:/laragon/www/Percobaan/sensor.php
    $conn = new mysqli("localhost", "username", "password", "database");
    ```

6. Jalankan server web Anda dan buka aplikasi di browser:

    ```sh
    http://localhost/repo-Sistem Monitoring Polusi Udara
    ```

## Penggunaan

1. Buka aplikasi di browser Anda.
2. Anda akan melihat data polusi udara terbaru, grafik data, dan peta lokasi.
3. Gunakan menu di samping kiri untuk melihat semua data atau data terbaru.

## Lisensi

Proyek ini dilisensikan di bawah lisensi MIT. Lihat file [LICENSE](http://_vscodecontentref_/0) untuk informasi lebih lanjut.

## Kontribusi

Kontribusi sangat diterima! Jika Anda ingin berkontribusi, silakan fork repositori ini dan buat pull request dengan perubahan Anda.

## Kontak

Jika Anda memiliki pertanyaan atau masalah, silakan hubungi kami di [733ffadhil@gmail.com].
