<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $sizes = ["S", "M", "L", "XL", "2XL", "3XL"];
        for ($i = 0; $i < count($sizes); $i++) {
            DB::table("sizes")->insert([
                "name" => $sizes[$i],
            ]);
        }

        $tracks = [
            "Pemesanan Sudah Masuk",
            "Bukti Pembayaran Sudah Masuk Ke Sistem",
            "Pembayaran Dikonfirmasi",
            "Proses Di Penjahit",
            "Pesanan Jadi",
            "Proses pengecekan",
            "Siap diambil"
        ];
        for ($i = 0; $i < count($tracks); $i++) {
            DB::table("tracks")->insert([
                "name" => $tracks[$i],
            ]);
        }
        $stocks = [1, 2, 3, 4, 5, 6];
        for($i = 0; $i < count($stocks); $i++) {
            DB::table("stocks")->insert([
                "stock" => 0,
                "size_id" => $stocks[$i]
            ]);
        }
        DB::table("users")->insert([
            "name" => "admin",
            "email" => "admin@mail",
            "password" => Hash::make("admin123")
        ]);
    }
}
