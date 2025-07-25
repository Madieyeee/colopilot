<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            ['id' => 1, 'name' => 'Les cordons verts', 'description' => 'Groupe des Les cordons verts'],
            ['id' => 2, 'name' => 'Les cordons bleus', 'description' => 'Groupe des Les cordons bleus'],
            ['id' => 3, 'name' => 'Les cordons oranges', 'description' => 'Groupe des Les cordons oranges'],
            ['id' => 4, 'name' => 'Les cordons noirs', 'description' => 'Groupe des Les cordons noirs'],
            ['id' => 5, 'name' => 'Les cordons jaunes', 'description' => 'Groupe des Les cordons jaunes'],
            ['id' => 6, 'name' => 'Les cordons rouges', 'description' => 'Groupe des Les cordons rouges'],
        ];

        foreach ($groups as $groupData) {
            Group::firstOrCreate(
                ['id' => $groupData['id']],
                ['name' => $groupData['name'], 'description' => $groupData['description']]
            );
        }
    }
}
