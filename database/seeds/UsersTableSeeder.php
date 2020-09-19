<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('plans')->get()->count() == 0){

            DB::table('users')->insert([
                'name' => 'Stephen Stack',
                'email' => 'admin@trach.io',
                'password' => bcrypt('123123123'),
                'email_verified_at' => '2020-01-04 16:13:59',
            ]);
        } else { echo "\e[31mTable is not empty, therefore NOT "; }
    }
}