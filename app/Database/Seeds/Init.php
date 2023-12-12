<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class Init extends Seeder
{
    public function run()
    {
        $data_kategori = [
            [
                'nama' => 'Celana panjang',
                'slug' => 'celana-panjang',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nama' => 'Celana pendek',
                'slug' => 'celana-pendek',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nama' => 'Kaos',
                'slug' => 'kaos',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nama' => 'Kemeja',
                'slug' => 'kemeja',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nama' => 'Sweater',
                'slug' => 'sweater',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nama' => 'Rok',
                'slug' => 'rok',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nama' => 'Jas',
                'slug' => 'jas',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nama' => 'Jaket',
                'slug' => 'jaket',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nama' => 'Dress',
                'slug' => 'dress',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
        ];

        $this->db->table('kategori')->insertBatch($data_kategori);

        $data_pakaian = [
            [
                'title' => 'Celana Panjang Denim Slim Fit',
                'slug' => 'celana-panjang-denim-slim-fit',
                'ukuran' => 'L',
                'deskripsi' => 'Celana panjang denim berkualitas tinggi dengan potongan slim fit, cocok untuk gaya santai maupun formal.',
                'harga' => 350000,
                'stok' => 52,
                'gambar' => 'celana-panjang.jpeg',
                'kategori_id' => 1,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'title' => 'Celana Pendek Cargo Outdoor',
                'slug' => 'celana-pendek-cargo-outdoor',
                'ukuran' => 'M',
                'deskripsi' => 'Celana pendek cargo dengan bahan berkualitas tinggi, cocok untuk gaya santai maupun formal.',
                'harga' => 250000,
                'stok' => 67,
                'gambar' => 'celana-pendek.jpeg',
                'kategori_id' => 2,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'title' => 'Kaos Grafis Vintage',
                'slug' => 'kaos-grafis-vintage',
                'ukuran' => 'L',
                'deskripsi' => 'Kaos grafis vintage dengan bahan berkualitas tinggi, cocok untuk gaya santai maupun formal.',
                'harga' => 1500000,
                'stok' => 25,
                'gambar' => 'kaos.jpeg',
                'kategori_id' => 3,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'title' => 'Kemeja Flanel Kotak-Kotak',
                'slug' => 'kemeja-flanel-kotak-kotak',
                'ukuran' => 'XL',
                'deskripsi' => 'Kemeja flanel kotak-kotak dengan bahan berkualitas tinggi, cocok untuk gaya santai maupun formal.',
                'harga' => 666000,
                'stok' => 32,
                'gambar' => 'kemeja.jpeg',
                'kategori_id' => 4,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'title' => 'Sweater Rajut Unisex',
                'slug' => 'sweater-rajut-unisex',
                'ukuran' => 'M',
                'deskripsi' => 'Sweater rajut unisex dengan bahan berkualitas tinggi, cocok untuk gaya santai maupun formal.',
                'harga' => 500000,
                'stok' => 12,
                'gambar' => 'sweater.jpeg',
                'kategori_id' => 5,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'title' => 'Rok Midi Polos',
                'slug' => 'rok-midi-polos',
                'ukuran' => 'S',
                'deskripsi' => 'Rok midi polos dengan bahan berkualitas tinggi, cocok untuk gaya santai maupun formal.',
                'harga' => 300000,
                'stok' => 43,
                'gambar' => 'rok.jpeg',
                'kategori_id' => 6,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'title' => 'Jas Formal Slim Fit',
                'slug' => 'jas-formal-slim-fit',
                'ukuran' => 'L',
                'deskripsi' => 'Jas formal slim fit dengan bahan berkualitas tinggi, cocok untuk gaya santai maupun formal.',
                'harga' => 1210000,
                'stok' => 21,
                'gambar' => 'jas.jpeg',
                'kategori_id' => 7,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'title' => 'Jaket Denim Vintage',
                'slug' => 'jaket-denim-vintage',
                'ukuran' => 'XL',
                'deskripsi' => 'Jaket denim vintage dengan bahan berkualitas tinggi, cocok untuk gaya santai maupun formal.',
                'harga' => 500000,
                'stok' => 32,
                'gambar' => 'jaket.jpeg',
                'kategori_id' => 8,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'title' => 'Dress',
                'slug' => 'dress',
                'ukuran' => 'M',
                'deskripsi' => 'Dress dengan bahan berkualitas tinggi, cocok untuk gaya santai maupun formal.',
                'harga' => 5500000,
                'stok' => 32,
                'gambar' => 'dress.jpeg',
                'kategori_id' => 9,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ]
        ];

        $this->db->table('pakaian')->insertBatch($data_pakaian);

        $data_pengguna = [
            [
                'firstName' => 'Admin',
                'lastName' => 'Tiara Brand',
                'email' => 'admin@gmail.com',
                'password' => 'admin2193',
                'isAdmin' => '1',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'firstName' => 'Vito',
                'lastName' => 'Ananta',
                'email' => 'vito1234@gmail.com',
                'password' => 'vito1234',
                'isAdmin' => '0',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'firstName' => 'Travis',
                'lastName' => 'Barker',
                'email' => 'travis182@blink.com',
                'password' => 'travis182',
                'isAdmin' => '0',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
        ];

        $this->db->table('pengguna')->insertBatch($data_pengguna);
    }
}
