<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Typology;

class TypologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'Pizza',
                'image' => 'https://images.app.goo.gl/T4jMQLW2FBgPNb356'
            ],
            [
                'name'=> 'Sushi',
                'image'=> 'https://images.app.goo.gl/EMGWvFDEyUxXUJYeA'
            ],
            [
                'name'=> 'Messicano',
                'image'=> 'https://cdn.discordapp.com/attachments/1090199171568500760/1090932785465786388/16801690350286996254972283672915.jpg'
            ],
            [
                'name'=> 'Fast-Food',
                'image'=> 'https://cdn.discordapp.com/attachments/1090199171568500760/1090933497922863135/photo-1568901346375-23c9450c58cd.jpeg'
            ],
        ];

        foreach($types as $type){
            $new_type = new Typology();
            $new_type->fill($type);
            $new_type->save();
        }
    }
}
