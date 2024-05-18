<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plats = [
            [
                'nom_plat' => 'Poulet rôti',
                'prix' => 2500,
                'image' => 'https://unsplash.com/fr/photos/poulet-frit-gE28aTnlqJA',
            ],
            [
                'nom_plat' => 'Lasagne',
                'prix' => 3000,
                'image' => 'https://unsplash.com/fr/photos/aliments-cuits-avec-sauce-PgkGsxjvGB4',
            ],
            [
                'nom_plat' => 'Saumon grillé',
                'prix' => 5000,
                'image' => 'https://unsplash.com/fr/photos/viande-grillee-aux-legumes-verts-sur-assiette-en-ceramique-noire-4WPcz_5RVMk',
            ],
            [
                'nom_plat' => 'Boeuf bourguignon',
                'prix' => 1500,
                'image' => 'https://unsplash.com/fr/photos/viande-avec-sauce-dans-un-bol-noir-xKSRpUH0VZo',
            ],
            [
                'nom_plat' => 'Salade niçoise',
                'prix' => 3000,
                'image' => 'https://unsplash.com/fr/photos/un-bol-de-salade-a-cote-dun-bol-dolives-T2jLTA3BwC8',
            ],
            [
                'nom_plat' => 'Pizza Margherita',
                'prix' => 4000,
                'image' => 'https://unsplash.com/fr/photos/pizza-sur-assiette-en-ceramique-bleue-frTrM7Gdkho',
            ],
            [
                'nom_plat' => 'Pâtes carbonara',
                'prix' => 3000,
                'image' => 'https://unsplash.com/fr/photos/pates-a-lassiette-avec-fourchette-t8hTmte4O_g',
            ],
            [
                'nom_plat' => 'Sushi',
                'prix' => 2500,
                'image' => 'https://unsplash.com/fr/photos/une-assiette-blanche-garnie-de-sushis-a-cote-dune-tasse-de-the-AsAnszAdzn8',
            ],
            [
                'nom_plat' => 'Curry de légumes',
                'prix' => 6000,
                'image' => 'https://unsplash.com/fr/photos/variete-de-legumes-910GanwBoew',
            ],
            [
                'nom_plat' => 'Tarte aux pommes',
                'prix' => 1500,
                'image' => 'https://unsplash.com/fr/photos/un-groupe-de-cookies-oo8qrSC8ls8',
            ],
        ];

        DB::table('plats')->insert($plats);
    }
}
