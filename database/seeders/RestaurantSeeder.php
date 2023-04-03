<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurants = [
            [
                'name' => 'Pizzeria da Ciccio',
                'address' => 'Via Lecco 27, Milano',
                'phone_number' =>  '0683649637',
                'description' =>  'Una pizzeria accogliente e informale che serve deliziose pizze cotte a legna, accompagnate da bevande fresche e una vasta selezione di antipasti e dessert.',
                'min_order' =>  '10.00',
                'shipment_price' =>  '1.99',
                'logo' =>  'https://images-ext-2.discordapp.net/external/Cc9Aos_9plvpTJttTpmsiExKFSDgmUXKLtrGIIWytac/https/img.italiaonline.it/0WO5p000003zlz6GAA_LogoCiccio.png',
            ],
            [
                'name' => 'Shizen',
                'address' => 'Via V. Bachelet 22, Viterbo',
                'phone_number' => '0761251242',
                'description' => "Un ristorante giapponese specializzato in sushi fresco e preparato al momento, con una vasta scelta di roll, nigiri e sashimi, serviti in un'atmosfera elegante e raffinata.",
                'min_order' => '15.00',
                'shipment_price' => '0.99',
                'logo' => 'https://t4.ftcdn.net/jpg/02/04/59/29/360_F_204592936_rvFaR64FC4hEXaNzdCrti7fNdRIjNYN4.jpg'
            ]
        ];

        foreach ($restaurants as $restaurant) {
            $new_restaurant = new Restaurant();

            $new_restaurant->fill($restaurant);

            $new_restaurant->save();
        }
    }
}
