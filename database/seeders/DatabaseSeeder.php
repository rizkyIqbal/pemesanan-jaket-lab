<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        for($i = 0; $i < count($sizes); $i++) {
            DB::table("sizes")->insert([
                "name" => $sizes[$i],
            ]);
        }

        $tracks = [
            "Pemesanan Sudah Masuk",
            "Pemesanan Sudah Masuk",
            "Pembayaran Dikonfirmasi",
            "Proses diPenjahit",
            "Pesanan Jadi",
            "Proses pengecekan",
            "Siap diambil"
        ];
        for($i = 0; $i < count($tracks); $i++) {
            DB::table("tracks")->insert([
                "name" => $tracks[$i],
            ]);
        }
    }
}
