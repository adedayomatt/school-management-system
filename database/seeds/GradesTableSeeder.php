<?php

use App\Grade;
use Illuminate\Database\Seeder;

class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grades = [
           [ 
            'alphabet' => 'A',
            'min' => 70,
            'max' => 100
            ],
            [ 
                'alphabet' => 'B',
                'min' => 60,
                'max' => 69
                ],
                [ 
                    'alphabet' => 'C',
                    'min' => 50,
                    'max' => 59
                    ],
                    [ 
                        'alphabet' => 'D',
                        'min' => 40,
                        'max' => 49
                        ], 
                        [ 
                            'alphabet' => 'E',
                            'min' => 30,
                            'max' => 39
                            ],
                            [ 
                                'alphabet' => 'F',
                                'min' => 0,
                                'max' => 29
                                ],

         ];

         foreach($grades as $grade){
             Grade::create($grade);
         }
    }
}
