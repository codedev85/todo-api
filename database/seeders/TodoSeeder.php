<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        User::create([
            'name' => $faker->name,
            'email'=>'test@todo.com',
            'password' => Hash::make('secret'),
        ]);

        $user = User::first();

        if($user){
            for($i = 0 ; $i < 20 ; $i++)
            Todo::create([
                'title' => $faker->text(30),
                'from' => $faker->dateTime,
                'to' => $faker->dateTime,
                'user_id' => $user->id
            ]);
        }

    }
}
