<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('activities')->truncate(); // Clear the table first

        $activities = [
            [
                'date' => '2025-07-07',
                'morning_activity' => 'Départ',
                'afternoon_activity' => 'Arrivée installation',
                'evening_activity' => 'Début /Inventaire',
                'responsible' => 'Directeur',
            ],
            [
                'date' => '2025-07-08',
                'morning_activity' => 'Pesée - forum, Code de conduite, (Répartition des familles) Inventaire',
                'afternoon_activity' => 'Inventaire - Découverte du milieu, Répartition ATM',
                'evening_activity' => 'Présentation, Bouillabaisse',
                'responsible' => 'Fatou Binetou Bane',
            ],
            [
                'date' => '2025-07-09',
                'morning_activity' => 'ATM(1)',
                'afternoon_activity' => 'ATM(2) / APS',
                'evening_activity' => 'Jeu : village olympique',
                'responsible' => 'Moussa ciss',
            ],
            [
                'date' => '2025-07-10',
                'morning_activity' => 'Première sortie : visite du village de kabrousse, djimbering et musée boucot Diola',
                'afternoon_activity' => 'ATM (3) / Répartition des Jeux Olympique de la Jeunesse',
                'evening_activity' => 'Conte et légende',
                'responsible' => 'Al Amine',
            ],
            [
                'date' => '2025-07-11',
                'morning_activity' => 'Démarrage des jeux Olympiques de la Jeunesse/ démarrage IA',
                'afternoon_activity' => 'Jeux olympiques, Atelier IA 1',
                'evening_activity' => 'Compétition Théâtrale',
                'responsible' => 'Paul Seck',
            ],
            [
                'date' => '2025-07-12',
                'morning_activity' => 'Journée médicale/ATM (4)/ Répartition ATS',
                'afternoon_activity' => 'Atelier IA (2) / fin ATM(5)',
                'evening_activity' => 'anniversaire',
                'responsible' => 'Yaye Salla, Fatou Thiam, Ndeye Comba',
            ],
            [
                'date' => '2025-07-13',
                'morning_activity' => 'Deuxième sortie : palais royal, Mlomp et Elinkine',
                'afternoon_activity' => 'Journée L’ Œuvre',
                'evening_activity' => 'Génie en herbe',
                'responsible' => 'Sarra Guissé et Mary Dabo',
            ],
            [
                'date' => '2025-07-14',
                'morning_activity' => 'ATS (1)/atelier IA (3)',
                'afternoon_activity' => 'ATS(2)/atelier IA (4)',
                'evening_activity' => 'Kassak',
                'responsible' => 'Bacary sarr',
            ],
            [
                'date' => '2025-07-15',
                'morning_activity' => 'Jeux /IA',
                'afternoon_activity' => 'Jeux/IA',
                'evening_activity' => 'khawaré',
                'responsible' => 'Bine Touré',
            ],
            [
                'date' => '2025-07-16',
                'morning_activity' => 'Troisième Sortie : les exploitation rizicoles et fruitières',
                'afternoon_activity' => 'ATS(3)/IA',
                'evening_activity' => 'Projection',
                'responsible' => 'Arona',
            ],
            [
                'date' => '2025-07-17',
                'morning_activity' => 'ATS(4)/IA',
                'afternoon_activity' => 'Kermesse',
                'evening_activity' => 'Année 80',
                'responsible' => 'Maimouna Kandé/ fatou B Bane, Ousmane Diagne',
            ],
            [
                'date' => '2025-07-18',
                'morning_activity' => 'ATS(5)/IA',
                'afternoon_activity' => 'Réplétion générale',
                'evening_activity' => 'Répétition Générale',
                'responsible' => 'Péda',
            ],
            [
                'date' => '2025-07-19',
                'morning_activity' => 'FETE DE LA COLONIE',
                'afternoon_activity' => 'FETE DE LA COLONIE',
                'evening_activity' => null,
                'responsible' => 'Péda',
            ],
            [
                'date' => '2025-07-20',
                'morning_activity' => 'Activité aquatique',
                'afternoon_activity' => 'APS',
                'evening_activity' => 'Veillée Ngel',
                'responsible' => 'Rémond Ciss, Mariama Faye, Doula Dieng',
            ],
            [
                'date' => '2025-07-21',
                'morning_activity' => 'olympiade',
                'afternoon_activity' => 'olympiade',
                'evening_activity' => 'assiko',
                'responsible' => 'Léopold, Khady Diagne',
            ],
            [
                'date' => '2025-07-22',
                'morning_activity' => 'Final olympiade',
                'afternoon_activity' => 'Finale olympiade',
                'evening_activity' => 'Cérémonie ( à l’africaine), Proclamation des résultats',
                'responsible' => 'Adolphe',
            ],
            [
                'date' => '2025-07-23',
                'morning_activity' => 'Activité aquatique',
                'afternoon_activity' => 'Activité aquatique',
                'evening_activity' => 'Veillée ethnique',
                'responsible' => 'Mary Dabo',
            ],
            [
                'date' => '2025-07-24',
                'morning_activity' => 'Quatrième sortie : Ziguinchor',
                'afternoon_activity' => 'Activité aquatique',
                'evening_activity' => 'Veillée projection',
                'responsible' => 'Arona',
            ],
            [
                'date' => '2025-07-25',
                'morning_activity' => 'Journée d’évaluation de groupe',
                'afternoon_activity' => 'Evaluation grand groupe',
                'evening_activity' => 'Veillée imitation',
                'responsible' => 'Sarra Guissé',
            ],
            [
                'date' => '2025-07-26',
                'morning_activity' => 'Pesée /inventaire',
                'afternoon_activity' => 'Inventaire/rangement',
                'evening_activity' => 'Veillée d’au revoir',
                'responsible' => 'péda',
            ],
            [
                'date' => '2025-07-27',
                'morning_activity' => 'RETOUR',
                'afternoon_activity' => 'Retour',
                'evening_activity' => 'retour',
                'responsible' => 'retour',
            ],
        ];

        foreach ($activities as $activity) {
            DB::table('activities')->insert([
                'date' => Carbon::parse($activity['date']),
                'morning_activity' => $activity['morning_activity'],
                'afternoon_activity' => $activity['afternoon_activity'],
                'evening_activity' => $activity['evening_activity'],
                'responsible' => $activity['responsible'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
