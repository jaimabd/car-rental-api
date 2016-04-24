<?php

use Illuminate\Database\Seeder;

class UserMaster extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
       		DB::table('user_master')->insert([

                'name' => 'admin',

                'email' => 'admin@gmail.com',

                'password' => '$2y$10$Nl1iAhyvdTWVSOEIlH9L6.UfgP3f0yIeV4.8RX4CJNB1xRgyrtjcy',
				
				'phone' => '',

             ]);
    }
}
