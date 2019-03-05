<?php

use App\SuperAdmin;
use App\User;
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
        $admins = [
            [
                'name' => 'Matt',
                'email' => 'adedayomatt@gmail.com',
                'phone' => '08139004572',
                'level' => 1,
                'password' => bcrypt('adedayokayode'),
            ],
            [
                'name' => 'Mrs. Stan-Njoku',
                'email' => 'go4realpeace17@gmail.com',
                'phone' => '08037269881',
                'level' => 2,
                'password' => bcrypt('08037269881'),
                ]
            ];

        foreach($admins as $admin){
            $user =  User::create([
                'email' => $admin['email'],
                'password' => $admin['password'],
                'status' => 'superadmin'
              ]);

              SuperAdmin::create([
                'user_id' => $user->id,
                'name' => $admin['name'],
                'phone' => $admin['phone'],
                'email' => $admin['email'],
                'level' => $admin['level']
              ]);

        }
    }
}
