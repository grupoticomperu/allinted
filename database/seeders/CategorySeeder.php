<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Cables de Red',
            'slug' => Str::slug('Cables de Red'),
            'state'=>1,
        ]);

        Category::create([
            'name' => 'Servidores',
            'slug' => Str::slug('Servidores'),
            'state'=>1,
        ]);

        Category::create([
            'name' => 'Modems',
            'slug' => Str::slug('Modems'),
            'state'=>1,
        ]);

        Category::create([
            'name' => 'Impresoras',
            'slug' => Str::slug('Impresoras'),
            'state'=>1,
        ]);
    }
}
