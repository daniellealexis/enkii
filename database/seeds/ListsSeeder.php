<?php

use App\Lists;
use App\User;
use Illuminate\Database\Seeder;

class ListsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lists::truncate();

        foreach (User::all() as $user)
        {
            $lists = factory(Lists::class, rand(10, 40))->make();
            foreach ($lists as $list)
                $user->lists()->save($list);
        }
    }
}
