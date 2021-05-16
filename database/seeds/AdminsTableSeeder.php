<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert(
            [
                [
                    'name' => 'Admin',
                    'username' => 'admin',
                    'password' => Hash::make('12345678'),
                    'type' => 'admin',
                    'status' => 1,
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s"),
                ],
                [
                    'name' => 'Duy Cường',
                    'username' => 'daicaxom',
                    'password' => Hash::make('12345678'),
                    'type' => 'admin',
                    'status' => 1,
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s"),
                ]
            ]
        );
    }
}
