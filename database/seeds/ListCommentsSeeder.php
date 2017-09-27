<?php

use App\ListComment;
use App\Lists;
use App\User;
use Illuminate\Database\Seeder;

class ListCommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ListComment::truncate();

        $count = User::all()->count();

        foreach (Lists::all() as $list)
        {
            factory(ListComment::class, rand(1, 30))->make()->each(function($c) use ($list, $count) {
                $c->user_id = rand(1, $count);
                $list->comments()->save($c);
            });
        }
    }
}