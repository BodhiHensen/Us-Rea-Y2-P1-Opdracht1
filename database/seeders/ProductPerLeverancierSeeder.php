<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductPerLeverancierSeeder extends Seeder
{
    public function run(): void
    {
        $ppl = [
            ['Id' => 1, 'LeverancierId' => 1, 'ProductId' => 1, 'DatumLevering' => '2024-11-09', 'Aantal' => 23, 'DatumEerstVolgendeLevering' => '2024-11-16'],
            ['Id' => 2, 'LeverancierId' => 1, 'ProductId' => 1, 'DatumLevering' => '2024-11-18', 'Aantal' => 21, 'DatumEerstVolgendeLevering' => '2024-11-25'],
            ['Id' => 3, 'LeverancierId' => 1, 'ProductId' => 2, 'DatumLevering' => '2024-11-09', 'Aantal' => 12, 'DatumEerstVolgendeLevering' => '2024-11-16'],
            ['Id' => 4, 'LeverancierId' => 1, 'ProductId' => 3, 'DatumLevering' => '2024-11-10', 'Aantal' => 11, 'DatumEerstVolgendeLevering' => '2024-11-17'],
            ['Id' => 5, 'LeverancierId' => 2, 'ProductId' => 4, 'DatumLevering' => '2024-11-14', 'Aantal' => 16, 'DatumEerstVolgendeLevering' => '2024-11-21'],
            ['Id' => 6, 'LeverancierId' => 2, 'ProductId' => 4, 'DatumLevering' => '2024-11-21', 'Aantal' => 23, 'DatumEerstVolgendeLevering' => '2024-11-28'],
            ['Id' => 7, 'LeverancierId' => 2, 'ProductId' => 5, 'DatumLevering' => '2024-11-14', 'Aantal' => 45, 'DatumEerstVolgendeLevering' => '2024-11-21'],
            ['Id' => 8, 'LeverancierId' => 2, 'ProductId' => 6, 'DatumLevering' => '2024-11-14', 'Aantal' => 30, 'DatumEerstVolgendeLevering' => '2024-11-21'],
            ['Id' => 9, 'LeverancierId' => 3, 'ProductId' => 7, 'DatumLevering' => '2024-11-12', 'Aantal' => 12, 'DatumEerstVolgendeLevering' => '2024-11-19'],
            ['Id' => 10, 'LeverancierId' => 3, 'ProductId' => 7, 'DatumLevering' => '2024-11-19', 'Aantal' => 23, 'DatumEerstVolgendeLevering' => '2024-11-26'],
            ['Id' => 11, 'LeverancierId' => 3, 'ProductId' => 8, 'DatumLevering' => '2024-11-10', 'Aantal' => 12, 'DatumEerstVolgendeLevering' => '2024-11-17'],
            ['Id' => 12, 'LeverancierId' => 3, 'ProductId' => 9, 'DatumLevering' => '2024-11-11', 'Aantal' => 1, 'DatumEerstVolgendeLevering' => '2024-11-18'],
            ['Id' => 13, 'LeverancierId' => 4, 'ProductId' => 10, 'DatumLevering' => '2024-11-16', 'Aantal' => 24, 'DatumEerstVolgendeLevering' => '2024-11-30'],
            ['Id' => 14, 'LeverancierId' => 5, 'ProductId' => 11, 'DatumLevering' => '2024-11-10', 'Aantal' => 47, 'DatumEerstVolgendeLevering' => '2024-11-17'],
            ['Id' => 15, 'LeverancierId' => 5, 'ProductId' => 11, 'DatumLevering' => '2024-11-19', 'Aantal' => 60, 'DatumEerstVolgendeLevering' => '2024-11-26'],
            ['Id' => 16, 'LeverancierId' => 5, 'ProductId' => 12, 'DatumLevering' => '2024-11-11', 'Aantal' => 45, 'DatumEerstVolgendeLevering' => null],
            ['Id' => 17, 'LeverancierId' => 5, 'ProductId' => 13, 'DatumLevering' => '2024-11-12', 'Aantal' => 23, 'DatumEerstVolgendeLevering' => null],
        ];

        foreach ($ppl as $item) {
            DB::table('ProductPerLeverancier')->updateOrInsert(
                ['Id' => $item['Id']],
                [
                    'LeverancierId' => $item['LeverancierId'],
                    'ProductId' => $item['ProductId'],
                    'DatumLevering' => $item['DatumLevering'],
                    'Aantal' => $item['Aantal'],
                    'DatumEerstVolgendeLevering' => $item['DatumEerstVolgendeLevering'],
                    'IsActief' => 1,
                    'Opmerkingen' => null,
                    'DatumAangemaakt' => now(),
                    'DatumGewijzigd' => now(),
                ]
            );
        }
    }
}
