<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $faker = Faker::create();

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
