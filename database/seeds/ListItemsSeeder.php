<?php

use App\ListItem;
use App\Lists;
use Illuminate\Database\Seeder;

class ListItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ListItem::truncate();

        foreach (Lists::all() as $list)
        {
            $items = factory(ListItem::class, rand(10, 20))->make();
            foreach ($items as $item)
                $list->listItems()->save($item);
        }
    }
}
