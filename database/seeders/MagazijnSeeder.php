<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MagazijnSeeder extends Seeder
{
    public function run(): void
    {
        $magazijn = [
            ['Id' => 1, 'ProductId' => 1, 'VerpakkingsEenheid' => 5.0, 'AantalAanwezig' => 453],
            ['Id' => 2, 'ProductId' => 2, 'VerpakkingsEenheid' => 2.5, 'AantalAanwezig' => 400],
            ['Id' => 3, 'ProductId' => 3, 'VerpakkingsEenheid' => 5.0, 'AantalAanwezig' => 1],
            ['Id' => 4, 'ProductId' => 4, 'VerpakkingsEenheid' => 1.0, 'AantalAanwezig' => 800],
            ['Id' => 5, 'ProductId' => 5, 'VerpakkingsEenheid' => 3.0, 'AantalAanwezig' => 234],
            ['Id' => 6, 'ProductId' => 6, 'VerpakkingsEenheid' => 2.0, 'AantalAanwezig' => 345],
            ['Id' => 7, 'ProductId' => 7, 'VerpakkingsEenheid' => 1.0, 'AantalAanwezig' => 795],
            ['Id' => 8, 'ProductId' => 8, 'VerpakkingsEenheid' => 10.0, 'AantalAanwezig' => 233],
            ['Id' => 9, 'ProductId' => 9, 'VerpakkingsEenheid' => 2.5, 'AantalAanwezig' => 123],
            ['Id' => 10, 'ProductId' => 10, 'VerpakkingsEenheid' => 3.0, 'AantalAanwezig' => null],
            ['Id' => 11, 'ProductId' => 11, 'VerpakkingsEenheid' => 2.0, 'AantalAanwezig' => 367],
            ['Id' => 12, 'ProductId' => 12, 'VerpakkingsEenheid' => 1.0, 'AantalAanwezig' => 467],
            ['Id' => 13, 'ProductId' => 13, 'VerpakkingsEenheid' => 5.0, 'AantalAanwezig' => 20],
        ];

        foreach ($magazijn as $item) {
            DB::table('Magazijn')->updateOrInsert(
                ['Id' => $item['Id']],
                [
                    'ProductId' => $item['ProductId'],
                    'VerpakkingsEenheid' => $item['VerpakkingsEenheid'],
                    'AantalAanwezig' => $item['AantalAanwezig'],
                    'IsActief' => 1,
                    'Opmerkingen' => null,
                    'DatumAangemaakt' => now(),
                    'DatumGewijzigd' => now(),
                ]
            );
        }
    }
}
