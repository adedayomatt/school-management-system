<?php

use App\Classroom;
use Illuminate\Database\Seeder;

class ClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classes = [
            'Playgroup 1',

            'Playgroup 2A',
            'Playgroup 2B',
            'Playgroup 2C',

            'Nursery 1A',
            'Nursery 1B',
            'Nursery 1C',

            'Nursery 2A',
            'Nursery 2B',
            'Nursery 2C',

            'Nursery 3A',
            'Nursery 3B',

            'Basic 1A',
            'Basic 1B',
            'Basic 1C',

            'Basic 2A',
            'Basic 2B',

            'Basic 3A',
            'Basic 3B',

            'Basic 4A',
            'Basic 4B',

            'Basic 5',
        ];

        foreach($classes as $class){
            Classroom::create([
                'name' => $class,
                'slug' => str_slug($class)
            ]);
        }
    }
}
