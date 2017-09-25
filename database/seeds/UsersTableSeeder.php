<?php

use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        factory(User::class)->create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@enkii.com',
        ]);

        factory(User::class, rand(10, 20))->create();
    }
}
