<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Food;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $foods = [
            [
                'name' => 'Pizza Mortadella',
                'price' => '12.50',
                'image' => 'https://mortadellabologna.com/wp-content/uploads/2021/09/pizza-mortadella-pistacchio-copertina.jpg',
                'description' => 'farina, pomodoro, mortadella, mozzarella',
                'is_public' => true,
            ],
            [
                'name' => 'Calzone',
                'price' => '10.50',
                'image' => 'https://i.pinimg.com/736x/58/9c/0b/589c0bbb6ac65e3529195daa5b1d81e7.jpg',
                'description' => 'farina, pomodoro, mozzarella, basilico',
                'is_public' => true,
            ],
            [
                'name' => 'Tacos',
                'price' => '8.50',
                'image' => 'https://cdn.discordapp.com/attachments/1090199171568500760/1090932785465786388/16801690350286996254972283672915.jpg',
                'description' => 'farina, pomodoro, mortadella, mozzarella',
                'is_public' => true,
            ],
            [
                'name' => 'Natto Maki',
                'price' => '8.50',
                'image' => 'https://img.freepik.com/premium-photo/tempura-maki-sushi-deep-fried-sushi-roll-served-wooden-board_356194-1617.jpg?w=360',
                'description' => 'farina, pomodoro, mortadella, mozzarella',
                'is_public' => true,
            ],
            [
                'name' => 'Maguro',
                'price' => '8.50',
                'image' => 'http://cdn.shopify.com/s/files/1/0575/8550/0204/products/999530048.jpg?v=1660547135',
                'description' => 'farina, pomodoro, mortadella, mozzarella',
                'is_public' => true,
            ],

        ];

        foreach ($foods as $food) {
            $new_food = new Food();
            $new_food->fill($food);
            $new_food->save();
        }
    }
}
