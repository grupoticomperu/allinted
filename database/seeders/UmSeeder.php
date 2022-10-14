<?php

namespace Database\Seeders;

use App\Models\Um;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Um::create([
            'name' => 'Kg',
            'slug' => Str::slug('Kg'),
            'abbreviation' => Str::slug('Kg'),
            'state'=>1,
        ]);

        Um::create([
            'name' => 'Rollo',
            'slug' => Str::slug('Rollo'),
            'abbreviation' => Str::slug('Rollo'),
            'state'=>1,
        ]);

        Um::create([
            'name' => 'Caja',
            'slug' => Str::slug('Caja'),
            'abbreviation' => Str::slug('Caja'),
            'state'=>1,
        ]);
    }
}
