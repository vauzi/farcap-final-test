<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profile::query()->create([
            'user_id'       => 1,
            'nomor_induk'   => 23456,
            'nama'          => 'John Doe',
            'foto'          => 'image/profile/12345.jpeg',
            'tgl_lahir'     => '1996-02-26',
            'gender'        => 'L',
            'alamat'        => 'RT. 12 RW. 01, jln. indah serba ada, Desa Kuluran, Kec. Kalitangah, Kab. Lamongan'
        ]);
    }
}
