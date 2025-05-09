# JANJI
Saya Abdurrahman Rauf Budiman dengan NIM 2301102 mengerjakan Tugas Praktikum 9 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

# Desain Program
Tugas Praktikum 9 ini yaitu untuk membuat Aplikasi manajemen data mahasiswa juga (seperti dengan Tugas Praktikum sebelumnya TP8). Hanya saja disini bentukan arsitektur OOP nya memakai MVP (Model-View-Presenter). Lalu program aplikasi ini juga menerapkan fitur membuat operasi CRUD (Create-Read-Update-Delete) pada tabel mahasiswa.

Berikut penjelasan lebih lanjutnya.

## 1. Penjelasan Detail Tabel Mahasiswa
Berikut isi atribut serta deskripsinya
| Atribut        | Deskripsi                              |
|----------------|----------------------------------------|
| `id`      | Identitas tabel mahasiswa (PK)             |
| `nim`         | Nomor Induk Mahasiswa                             |
| `nama`  | Nama Mahasiswa                      |
| `tempat`          | Tempat Lahir                             |
| `tl`          | Tanggal Lahir                             |
| `gender`          | Jenis Kelamin                             |
| `email`          | Email Mahasiswa                             |
| `telp`          | No telefon mahasiswa                             |

Keterangan:
Tabel student ini akan menjadi main table yang berisi semua identitas atau biodata pada mahasiswa. Memiliki foreign key yang merujuk ke table prestasi dan akademik

## 2. Struktur Folder Proyek
![image](https://github.com/user-attachments/assets/472659cf-1f0f-4bb1-8bbc-cafbf9716a27)

Keterangan:
Pada project ini, terdapat 4 folder utama yang saling terkait:
- presenter → Berisi/bersifat sebagai Presenter yang isinya itu logika bisnis dan koordinasi antara Model dan View.
- model → Isinya berbagai kelas untuk mengelola database (seperti DB.class.php) dan operasi data tiap tabel.
- view → Intinya memproses template dan menampilkan data yang diterima dari Presenter.
- template → Berisi file HTML mentah dengan placeholder teks yang akan di-render oleh si View.
- entry point (index.php) → file ini sebagai rute semua eksekusi operasi crud dan menerima segala request.

# Alur Program
Pertama tama kita pastikan server Apache dan MySQL menyala, lalu buka browser dan di url nya itu ditujukan ke index.php. Setelah muncul visualisasinya, di index.php (halaman utama) akan langsung menampilkan data tabel mahasiswa. Disitu kita bisa melakukan `TAMBAH`, aksi `EDIT`, dan aksi `DELETE`. Jika diklik tombol tambah mahasiswa akan redirect ke form halaman tambah, sebaliknya jika diklik tombol aksi edit akan redirect ke form halaman edit serta mengfetch isi sebelumnya kedalam form tersebut.

# Rekaman Dokumentasi Alur Program
https://github.com/user-attachments/assets/f6519614-fff8-45ce-998c-b4319c2f1370



