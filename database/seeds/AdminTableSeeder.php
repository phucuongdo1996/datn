<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user_code' => '195001E000000',
            'name' => 'Admin',
            'email' => 'admin',
            'role' => ADMIN,
            'password' => password_hash('Admin@123', PASSWORD_BCRYPT),
            'status' => ACTIVE_SUCCESS,
            'group_code' => '195001E000000'
        ]);
    }
}
