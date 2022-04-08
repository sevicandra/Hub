<?php

namespace Database\Seeders;

use App\Models\role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        role::create(['kode'=>1, 'role'=> 'plt. Kepala Kantor']);
        role::create(['kode'=>2, 'role'=> 'plt. Kepala Subbagian Umum']);
        role::create(['kode'=>3, 'role'=> 'plt. Kepala Seksi Pengelolaan Kekayaan Negara']);
        role::create(['kode'=>4, 'role'=> 'plt. Kepala Seksi Piutang Negara']);
        role::create(['kode'=>5, 'role'=> 'plt. Kepala Seksi Hukum dan Informasi']);
        role::create(['kode'=>6, 'role'=> 'plt. Kepala Seksi Kepatuhan Internal']);
        role::create(['kode'=>7, 'role'=> 'Kepegawaian']);
        role::create(['kode'=>8, 'role'=> 'Keuangan']);
        role::create(['kode'=>9, 'role'=> 'Penilaian']);
        role::create(['kode'=>10, 'role'=> 'Lelanga']);
    }
}
