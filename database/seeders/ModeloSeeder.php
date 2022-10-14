<?php

namespace Database\Seeders;

use App\Models\Modelo;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;

class ModeloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Modelo::create([
            'name' => 'Modelo1',
            'slug' => Str::slug('Modelo1'),
            'state'=>1,
        ]);

        Modelo::create([
            'name' => 'Modelo2',
            'slug' => Str::slug('Modelo2'),
            'state'=>1,
        ]);

        Modelo::create([
            'name' => 'Modelo3',
            'slug' => Str::slug('Modelo3'),
            'state'=>1,
        ]);
    }
}
