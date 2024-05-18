<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuJournalierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'date_menu' => 'lundi',
                'id_plat' => 1,
                'id_accompagnement' => json_encode([rand(1,10),rand(1,10),rand(1,10)]),
            ],
            [
                'date_menu' => 'lundi',
                'id_plat' => 2,
                'id_accompagnement' => json_encode([rand(1,10),rand(1,10),rand(1,10)]),

            ],
            [
                'date_menu' => 'lundi',
                'id_plat' => 3,
                'id_accompagnement' => json_encode([rand(1,10),rand(1,10),rand(1,10)]),

            ],

            [
                'date_menu' => 'mardi',
                'id_plat' => 2,
                'id_accompagnement' => json_encode([rand(1,10),rand(1,10),rand(1,10)]),

            ],
            [
                'date_menu' => 'mardi',
                'id_plat' => 3,
                'id_accompagnement' => json_encode([rand(1,10),rand(1,10),rand(1,10)]),

            ],
            [
                'date_menu' => 'mardi',
                'id_plat' => 4,
                'id_accompagnement' => json_encode([rand(1,10),rand(1,10),rand(1,10)]),

            ],


            [
                'date_menu' => 'mercredi',
                'id_plat' => 3,
                'id_accompagnement' => json_encode([rand(1,10),rand(1,10),rand(1,10)]),

            ],
            [
                'date_menu' => 'mercredi',
                'id_plat' => 4,
                'id_accompagnement' => json_encode([rand(1,10),rand(1,10),rand(1,10)]),

            ],
            [
                'date_menu' => 'mercredi',
                'id_plat' => 5,
                'id_accompagnement' => json_encode([rand(1,10),rand(1,10),rand(1,10)]),
            ],

            [
                'date_menu' => 'jeudi',
                'id_plat' => 4,
                'id_accompagnement' => json_encode([rand(1,10),rand(1,10),rand(1,10)]),

            ],
            [
                'date_menu' => 'jeudi',
                'id_plat' => 1,
                'id_accompagnement' => json_encode([rand(1,10),rand(1,10),rand(1,10)]),
            ],
            [
                'date_menu' => 'jeudi',
                'id_plat' => 2,
                'id_accompagnement' => json_encode([rand(1,10),rand(1,10),rand(1,10)]),

            ],

            [
                'date_menu' => 'vendredi',
                'id_plat' => 5,
                'id_accompagnement' => json_encode([rand(1,10),rand(1,10),rand(1,10)]),
            ],
            [
                'date_menu' => 'vendredi',
                'id_plat' => 2,
                'id_accompagnement' => json_encode([rand(1,10),rand(1,10),rand(1,10)]),

            ],
            [
                'date_menu' => 'vendredi',
                'id_plat' => 3,
                'id_accompagnement' => json_encode([rand(1,10),rand(1,10),rand(1,10)]),

            ],
        ];

        DB::table('menus_journaliers')->insert($menus);
    }
}
