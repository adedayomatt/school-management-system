<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ClassesTableSeeder::class);
        $this->call(TermsTableSeeder::class);
        $this->call(GradesTableSeeder::class);
        $this->call(SettingsSeeder::class);
    }
}
