<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeverancierSeeder extends Seeder
{
    public function run(): void
    {
        $leveranciers = [
            ['Id' => 1, 'Naam' => 'Venco', 'ContactPersoon' => 'Bert van Linge', 'LeverancierNummer' => 'L1029384719', 'Mobiel' => '06-28493827'],
            ['Id' => 2, 'Naam' => 'Astra Sweets', 'ContactPersoon' => 'Jasper del Monte', 'LeverancierNummer' => 'L1029284315', 'Mobiel' => '06-39398734'],
            ['Id' => 3, 'Naam' => 'Haribo', 'ContactPersoon' => 'Sven Stalman', 'LeverancierNummer' => 'L1029324748', 'Mobiel' => '06-24383291'],
            ['Id' => 4, 'Naam' => 'Basset', 'ContactPersoon' => 'Joyce Stelterberg', 'LeverancierNummer' => 'L1023845773', 'Mobiel' => '06-48293823'],
            ['Id' => 5, 'Naam' => 'De Bron', 'ContactPersoon' => 'Remco Veenstra', 'LeverancierNummer' => 'L1023857736', 'Mobiel' => '06-34291234'],
        ];

        foreach ($leveranciers as $leverancier) {
            DB::table('Leverancier')->updateOrInsert(
                ['Id' => $leverancier['Id']],
                [
                    'Naam' => $leverancier['Naam'],
                    'ContactPersoon' => $leverancier['ContactPersoon'],
                    'LeverancierNummer' => $leverancier['LeverancierNummer'],
                    'Mobiel' => $leverancier['Mobiel'],
                    'IsActief' => 1,
                    'Opmerkingen' => null,
                    'DatumAangemaakt' => now(),
                    'DatumGewijzigd' => now(),
                ]
            );
        }
    }
}
