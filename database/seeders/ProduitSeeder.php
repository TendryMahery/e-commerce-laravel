<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('produits')->insert([
           'name' => "phone",
           'price' => 45000,
           'category' => "akanjo",
           'description' => "akanjo mena",
           'gallery' => "image/3440.jpg"
        ],


    );
    }
}
