<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MonitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $monitors = [
            ['name' => 'MOUSSA CISS', 'phone' => '775435361'],
            ['name' => 'AL AMINE DIOP', 'phone' => '773773461'],
            ['name' => 'MOUSTAPHA DIEDHOU', 'phone' => '774074366'],
            ['name' => 'MARIAMA DABO', 'phone' => '775504134'],
            ['name' => 'NDEYE MARIAMA FAYE', 'phone' => '775772201'],
            ['name' => 'BINE TOURE', 'phone' => '774804196'],
            ['name' => 'DOULA DIENG', 'phone' => '774571411'],
            ['name' => 'LEOPALD MAME BIRAM FAYE', 'phone' => '771725929'],
            ['name' => 'BABACAR NDIAYE', 'phone' => '773069826'],
            ['name' => 'FATOU THIAM', 'phone' => '771735700'],
            ['name' => 'FATOU NAM', 'phone' => '772785878'],
            ['name' => 'PAULE SECK', 'phone' => '777924146'],
            ['name' => 'RAYMOND CISS', 'phone' => '777810537'],
            ['name' => 'ABDOUL AZIZ MBAYE', 'phone' => '776567640'],
            ['name' => 'MAIMOUNA KANDE', 'phone' => '775269763'],
            ['name' => 'OUSMANE DIAGNE', 'phone' => '772464551'],
            ['name' => 'BABACAR NDIAYE', 'phone' => '782515799'],
            ['name' => 'BAKARY SARR', 'phone' => '774050002'],
            ['name' => 'FATOU BINETOU BANE', 'phone' => '776114994'],
            ['name' => 'BABACAR DIOUF', 'phone' => '775195225'],
            ['name' => 'NDEYE COUMBA KOUATE', 'phone' => '768857504'],
            ['name' => 'MADIEYE ANNE', 'phone' => '779553758'],
        ];

        foreach ($monitors as $monitor) {
            // Create a unique email based on the name to avoid conflicts
            $email = Str::slug($monitor['name']) . '-' . $monitor['phone'] . '@colopilot.app';

            User::updateOrCreate(
                ['phone_number' => $monitor['phone']], // Use phone number as the unique key
                [
                    'name' => $monitor['name'],
                    'email' => $email,
                    'password' => Hash::make(Str::random(20)), // Secure, random, unusable password
                    'role' => 'moniteur',
                ]
            );
        }
    }
}