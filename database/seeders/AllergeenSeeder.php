<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AllergeenSeeder extends Seeder
{
    public function run(): void
    {
        $allergenen = [
            ['Id' => 1, 'Naam' => 'Gluten', 'Omschrijving' => 'Dit product bevat gluten'],
            ['Id' => 2, 'Naam' => 'Gelatine', 'Omschrijving' => 'Dit product bevat gelatine'],
            ['Id' => 3, 'Naam' => 'AZO-Kleurstof', 'Omschrijving' => 'Dit product bevat AZO-kleurstoffen'],
            ['Id' => 4, 'Naam' => 'Lactose', 'Omschrijving' => 'Dit product bevat lactose'],
            ['Id' => 5, 'Naam' => 'Soja', 'Omschrijving' => 'Dit product bevat soja'],
        ];

        foreach ($allergenen as $allergeen) {
            DB::table('Allergeen')->updateOrInsert(
                ['Id' => $allergeen['Id']],
                [
                    'Naam' => $allergeen['Naam'],
                    'Omschrijving' => $allergeen['Omschrijving'],
                    'IsActief' => 1,
                    'Opmerkingen' => null,
                    'DatumAangemaakt' => now(),
                    'DatumGewijzigd' => now(),
                ]
            );
        }
    }
}
