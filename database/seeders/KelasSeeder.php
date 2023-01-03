<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kelas::query()->create([
            'kelas' => 'VII',
        ]);
        Kelas::query()->create([
            'kelas' => 'VIII',
        ]);
        Kelas::query()->create([
            'kelas' => 'XI',
        ]);
    }
}
