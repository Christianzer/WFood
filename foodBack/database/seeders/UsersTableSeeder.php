<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Aka Christian',
            'email' => 'christian@gmail.com',
            'type'=>1,
            'password' => md5('admin')
        ]);

        DB::table('users')->insert([
            'name' => 'Cedric Aka',
            'email' => 'cedric@gmail.com',
            'type'=>2,
            'password' => md5('admin')
        ]);
    }
}
