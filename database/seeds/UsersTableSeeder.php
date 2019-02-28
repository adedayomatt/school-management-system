<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      User::create([
        'email' => 'adedayomatt@gmail.com',
        'password' => bcrypt('adedayokayode'),
        'status' => 'superadmin'
      ]);
      
  }
}
