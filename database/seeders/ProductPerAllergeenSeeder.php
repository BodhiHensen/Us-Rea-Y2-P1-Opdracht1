<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductPerAllergeenSeeder extends Seeder
{
    public function run(): void
    {
        $ppa = [
            ['Id' => 1, 'ProductId' => 1, 'AllergeenId' => 2],
            ['Id' => 2, 'ProductId' => 1, 'AllergeenId' => 1],
            ['Id' => 3, 'ProductId' => 1, 'AllergeenId' => 3],
            ['Id' => 4, 'ProductId' => 3, 'AllergeenId' => 4],
            ['Id' => 5, 'ProductId' => 6, 'AllergeenId' => 5],
            ['Id' => 6, 'ProductId' => 9, 'AllergeenId' => 2],
            ['Id' => 7, 'ProductId' => 9, 'AllergeenId' => 5],
            ['Id' => 8, 'ProductId' => 10, 'AllergeenId' => 2],
            ['Id' => 9, 'ProductId' => 12, 'AllergeenId' => 4],
            ['Id' => 10, 'ProductId' => 13, 'AllergeenId' => 1],
            ['Id' => 11, 'ProductId' => 13, 'AllergeenId' => 4],
            ['Id' => 12, 'ProductId' => 13, 'AllergeenId' => 5],
        ];

        foreach ($ppa as $item) {
            DB::table('ProductPerAllergeen')->updateOrInsert(
                ['Id' => $item['Id']],
                [
                    'ProductId' => $item['ProductId'],
                    'AllergeenId' => $item['AllergeenId'],
                    'IsActief' => 1,
                    'Opmerkingen' => null,
                    'DatumAangemaakt' => now(),
                    'DatumGewijzigd' => now(),
                ]
            );
        }
    }
}
