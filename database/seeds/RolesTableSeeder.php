<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [ 'Administrator','Teacher','Assistant Teacher'];
        foreach($roles as $role){
                Role::create([
                    'name' => $role,
                    'slug' => str_slug($role)
                ]);
            }
       
    }
}
