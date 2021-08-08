<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

date_default_timezone_set("Asia/Jakarta");

class DataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Input to Level Table
        DB::table('levels')->insert([
            'deskripsi' => 'Admin',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('levels')->insert([
            'deskripsi' => 'Perusahaan',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        // Input to User Table
        DB::table('users')->insert([
            'nama' => 'Admin 1',
            'email' => "admin_1@gmail.com",
            'password' => "admin_12345",
            'level_id' => "1",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
