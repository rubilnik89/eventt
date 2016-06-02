<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Article::create([
            'title' => 'Pete Houston',
            'content' => 'petehouston',

        ]);
        \App\Article::create([
            'title' => 'Taylor Otwell',
            'content' => 'taylorotwell',
                    ]);
        // $this->call('UserTableSeeder');
    }


}
