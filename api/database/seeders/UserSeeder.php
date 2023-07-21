<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            [
                "username"=>'yinsoknara',
                "email"=>'yinsoknara@gmail.com',
                "phone"=> '0123322333',
                "password"=> bcrypt('123456'),
                "role"=> 1,
                "image_url"=> null,
                "created_at"=> date('Y-m-d H:i:s'),
            ],
            [
                "username"=>'tester',
                "email"=>'tester@gmail.com',
                "phone"=> '01233223323',
                "password"=> bcrypt('123456'),
                "role"=> 2,
                "image_url"=> null,
                "created_at"=> date('Y-m-d H:i:s'),
            ]
        ]);
    }
}
