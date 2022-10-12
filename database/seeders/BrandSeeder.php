<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::create([
            'name' => 'LG',
            'slug' => Str::slug('LG'),
            'state'=>1,
        ]);

        Brand::create([
            'name' => 'Intel',
            'slug' => Str::slug('Intel'),
            'state'=>1,
        ]);
        Brand::create([
            'name' => 'MD',
            'slug' => Str::slug('MD'),
            'state'=>1,
        ]);
        Brand::create([
            'name' => 'Logitech',
            'slug' => Str::slug('Logitech'),
            'state'=>1,
        ]);
        Brand::create([
            'name' => 'Lenovo',
            'slug' => Str::slug('Lenovo'),
            'state'=>1,
        ]);
    }
}
