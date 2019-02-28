<?php

use Illuminate\Database\Seeder;

use App\Term;
class TermsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Term::create([
            'session' => '2018/2019',
            'term' => 1,
            'start' => '2019-01-01',
            'end' => '2019-06-01'
        ]);

    }
}
