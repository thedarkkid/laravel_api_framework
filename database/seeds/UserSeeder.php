<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 5)->create()->each(function ($user) {
            $articles = array_merge(
                factory(App\Article::class, 2)->state('hidden')->make()->toArray(),
                factory(App\Article::class, 3)->state('visible')->make()->toArray()
            );
            $user->articles()->createMany($articles);
        });
    }
}
