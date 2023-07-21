<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->insert([
            [
                'role'=>'admin',
                'created_at'=> date('Y-m-d H:i:s')
            ],
            [
                'role'=>'user',
                'created_at'=> date('Y-m-d H:i:s')
            ]
        ]);
    }
}
