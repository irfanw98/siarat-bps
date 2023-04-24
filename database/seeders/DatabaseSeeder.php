<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $user = [
            [
                'name' => 'TU',
                'username' => 'tu123',
                'password' => bcrypt('tu123'),
                'role' => 'tu',
                'jabatan' => 'Tata Usaha'
            ],
            [
                'name' => 'KEPALA',
                'username' => 'kepala123',
                'password' => bcrypt('kepala123'),
                'role' => 'kepala',
                'jabatan' => 'Kepala'
            ],
            [
                'name' => 'Benny',
                'username' => 'benny123',
                'password' => bcrypt('benny123'),
                'role' => 'pegawai',
                'jabatan' => 'Bendahara'
            ],
            [
                'name' => 'Ratna',
                'username' => 'ratna123',
                'password' => bcrypt('ratna123'),
                'role' => 'pegawai',
                'jabatan' => 'Sekretaris'
            ]
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}