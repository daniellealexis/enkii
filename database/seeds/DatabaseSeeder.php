<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        if (App::environment('production'))
            $this->seedProduction();
        else
            $this->seedDev();

        Model::reguard();
    }

    private function seedDev()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ListsSeeder::class);
        $this->call(ListItemsSeeder::class);
        $this->call(ListCommentsSeeder::class);
        $this->call(CommentFilterSeeder::class);
    }

    private function seedProduction()
    {
        $this->call(CommentFilterSeeder::class);
    }
}
