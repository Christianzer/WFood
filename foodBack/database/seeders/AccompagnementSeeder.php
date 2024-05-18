<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccompagnementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accompagnements = [
            [
                'nom_accompagnement' => 'Riz',
                'prix' => 500,
            ],
            [
                'nom_accompagnement' => 'Purée de pommes de terre',
                'prix' => 500,
            ],
            [
                'nom_accompagnement' => 'Légumes sautés',
                'prix' => 750,
            ],
            [
                'nom_accompagnement' => 'Salade verte',
                'prix' => 300,
            ],
            [
                'nom_accompagnement' => 'Frites',
                'prix' => 1000,
            ],
            [
                'nom_accompagnement' => 'Ratatouille',
                'prix' => 500,
            ],
            [
                'nom_accompagnement' => 'Polenta',
                'prix' => 500,
            ],
            [
                'nom_accompagnement' => 'Soupe',
                'prix' => 1000,
            ],
            [
                'nom_accompagnement' => 'Yaourt',
                'prix' => 500,
            ],
            [
                'nom_accompagnement' => 'Fruits frais',
                'prix' => 250,
            ],
        ];

        DB::table('accompagnements')->insert($accompagnements);
    }
}
