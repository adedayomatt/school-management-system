<?php

use App\SuperAdmin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SuperAdmin::create([
            'user_id' => 1,
            'name' => 'Matt',
            'phone' => '08139004572',
            'email' => 'adedayomatt@gmail.com'
          ]);

    }
}
