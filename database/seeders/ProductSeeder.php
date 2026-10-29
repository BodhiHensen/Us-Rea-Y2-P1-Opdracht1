<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['Id' => 1, 'Naam' => 'Mintnopjes', 'Barcode' => '8719587231278'],
            ['Id' => 2, 'Naam' => 'Schoolkrijt', 'Barcode' => '8719587326713'],
            ['Id' => 3, 'Naam' => 'Honingdrop', 'Barcode' => '8719587327836'],
            ['Id' => 4, 'Naam' => 'Zure Beren', 'Barcode' => '8719587321441'],
            ['Id' => 5, 'Naam' => 'Cola Flesjes', 'Barcode' => '8719587321237'],
            ['Id' => 6, 'Naam' => 'Turtles', 'Barcode' => '8719587322245'],
            ['Id' => 7, 'Naam' => 'Witte Muizen', 'Barcode' => '8719587328256'],
            ['Id' => 8, 'Naam' => 'Reuzen Slangen', 'Barcode' => '8719587325641'],
            ['Id' => 9, 'Naam' => 'Zoute Rijen', 'Barcode' => '8719587322739', 'IsActief' => 1],
            ['Id' => 10, 'Naam' => 'Winegums', 'Barcode' => '8719587327527', 'IsActief' => 0],
            ['Id' => 11, 'Naam' => 'Drop Munten', 'Barcode' => '8719587322345', 'IsActief' => 1],
            ['Id' => 12, 'Naam' => 'Kruis Drop', 'Barcode' => '8719587322265'],
            ['Id' => 13, 'Naam' => 'Zoute Ruitjes', 'Barcode' => '8719587323256'],
        ];

        foreach ($products as $product) {
            DB::table('Product')->updateOrInsert(
                ['Id' => $product['Id']],
                [
                    'Naam' => $product['Naam'],
                    'Barcode' => $product['Barcode'],
                    'IsActief' => $product['IsActief'] ?? 1,
                    'Opmerkingen' => null,
                    'DatumAangemaakt' => now(),
                    'DatumGewijzigd' => now(),
                ]
            );
        }
    }
}
