<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Models\Group;
use App\Models\User;
use App\Models\Child;
use Carbon\Carbon;

class ColonieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pour garantir que le seeder peut être relancé, on vide les tables.
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Group::truncate();
        User::truncate();
        Child::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Création de l'utilisateur administrateur principal
        User::create([
            'name' => 'madieye',
            'email' => 'admin@colopilot.test',
            'password' => Hash::make('tresor2025'),
            'role' => 'administrateur',
        ]);

        // Création de l'utilisateur Directeur
        User::create([
            'name' => 'Directeur',
            'username' => 'directeur',
            'email' => 'directeur@colopilot.test',
            'password' => Hash::make('tresor2025'),
            'role' => 'directeur',
        ]);

        // Création de l'utilisateur Infirmier
        User::create([
            'name' => 'Infirmier',
            'username' => 'infirmier',
            'email' => 'infirmier@colopilot.test',
            'password' => Hash::make('tresor2025'),
            'role' => 'infirmier',
        ]);

        $filePath = 'c:\\Users\\bmd tech\\Downloads\\System de gestion de colonie\\GroupesTresor2025.txt';
        if (!File::exists($filePath)) {
            $this->command->error("Le fichier de données n'a pas été trouvé : $filePath");
            return;
        }
        $content = File::get($filePath);

        $groupBlocks = preg_split('/\f/', $content);

        foreach ($groupBlocks as $block) {
            $block = trim($block);
            if (empty($block)) continue;

            $lines = array_map('trim', explode("\n", $block));
            
            preg_match('/GROUPE\s*\d+\s*:\s*(Les cordons (.*))/i', $lines[0], $groupMatches);
            $groupName = $groupMatches[1] ?? 'Groupe Inconnu';
            $groupColor = rtrim(strtolower($groupMatches[2] ?? 'inconnu'), 's');

            $group = Group::create([
                'name' => $groupName,
                'description' => "Groupe des $groupName"
            ]);

            $responsableName = '';
            foreach ($lines as $line) {
                if (preg_match('/^RESPONSABLE\s*:\s*(.*)/i', $line, $matches)) {
                    $responsableName = trim($matches[1]);
                    break; // On a trouvé le responsable, on peut arrêter
                }
            }

            if (!empty($responsableName)) {
                // Le nom d'utilisateur est basé sur la couleur, qui est unique par groupe.
                $username = 'responsable' . str_replace(' ', '', $groupColor);

                $user = User::create([
                    'name' => $responsableName,
                    'username' => $username,
                    'email' => $username . '@colopilot.test',
                    'password' => Hash::make('tresor2025'),
                    'role' => 'moniteur',
                    'group_id' => $group->id,
                ]);

                $this->command->info("Moniteur '{$user->name}' créé avec l'identifiant '{$user->username}' et assigné au groupe '{$group->name}'.");
            }

            $childrenListStarted = false;
            $childListIndex = null;
            foreach ($lines as $index => $line) {
                if (str_contains(strtoupper($line), 'LISTE DES COLONS')) {
                    $childListIndex = $index;
                    $childrenListStarted = true;
                    continue;
                }
                if (!$childrenListStarted) continue;
            }

            if ($childListIndex !== null) {
                $childLines = array_slice($lines, $childListIndex + 2);
                foreach ($childLines as $childLine) {
                    if (empty(trim($childLine))) continue;

                    // Normalize age format (e.g., "7ANS" -> "7") and remove extra spaces
                    $cleanedLine = preg_replace('/(\d+)\s*ANS/i', '$1', $childLine);
                    $parts = preg_split('/\s+/', trim($cleanedLine));

                    if (count($parts) < 4) {
                        // Log or skip malformed lines
                        $this->command->warn("Skipping malformed line: " . $childLine);
                        continue;
                    }

                    // Extract data from the end of the array
                    $gender = array_pop($parts);
                    $age = (int)array_pop($parts);
                    $lastName = array_pop($parts);
                    
                    // The rest is the first name (after removing the number at the beginning)
                    array_shift($parts);
                    $firstName = implode(' ', $parts);

                    Child::create([
                        'first_name' => $firstName,
                        'last_name' => $lastName,
                        'date_of_birth' => Carbon::now()->subYears($age), // Gardé pour la cohérence, mais non utilisé pour l'affichage de l'âge.
                        'gender' => $gender,
                        'age' => $age, // On stocke l'âge directement.
                        'group_id' => $group->id,
                    ]);
                }
            }
        }
    }
}
