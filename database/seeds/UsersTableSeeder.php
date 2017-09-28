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
        ])->each(function($user) {
            $token = $user->createToken('postman')->accessToken;
            $fh = fopen('postman_token.txt', 'w');
            fwrite($fh, $token);
            fclose($fh);
        });

        factory(User::class, rand(10, 20))->create();
    }
}
