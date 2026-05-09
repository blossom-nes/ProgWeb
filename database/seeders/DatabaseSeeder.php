<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Discipline;
use App\Models\Tour;
use App\Models\Site;
use App\Models\Competition;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // ── Compte admin (organisateur) ──────────────────────────────
        User::create([
            'name'     => 'Admin JO',
            'email'    => 'admin@jo.fr',
            'password' => bcrypt('password'),
            'role'     => 'admin',
        ]);

        // Compte visiteur normal pour tester
        User::create([
            'name'     => 'Test User',
            'email'    => 'user@jo.fr',
            'password' => bcrypt('password'),
            'role'     => 'user',
        ]);

        // ── 5 Disciplines ────────────────────────────────────────────
        $patinage   = Discipline::create(['nom' => 'Patinage artistique']);
        $ski        = Discipline::create(['nom' => 'Ski alpin']);
        $biathlon   = Discipline::create(['nom' => 'Biathlon']);
        $bobsleigh  = Discipline::create(['nom' => 'Bobsleigh']);
        $hockey     = Discipline::create(['nom' => 'Hockey sur glace']);

        // ── Tours pour chaque discipline (Qualifications + Finale) ───
        $tours = [];
        foreach ([$patinage, $ski, $biathlon, $bobsleigh, $hockey] as $discipline) {
            $tours[$discipline->id]['qualif'] = Tour::create([
                'nom'           => 'Qualifications',
                'discipline_id' => $discipline->id,
            ]);
            $tours[$discipline->id]['finale'] = Tour::create([
                'nom'           => 'Finale',
                'discipline_id' => $discipline->id,
            ]);
        }

        // ── 5 Sites avec capacité ────────────────────────────────────
        $assago   = Site::create(['nom' => 'Forum di Assago',       'capacite_max' => 12000]);
        $stelvio  = Site::create(['nom' => 'Piste Stelvio',         'capacite_max' => 8000]);
        $mediolan = Site::create(['nom' => 'PalaSharp Milano',      'capacite_max' => 5000]);
        $cortina  = Site::create(['nom' => 'Piste Olympia Cortina', 'capacite_max' => 6000]);
        $verona   = Site::create(['nom' => 'Arena di Verona',       'capacite_max' => 15000]);

        // ── Compétitions ─────────────────────────────────────────────
        // Patinage artistique
        Competition::create([
            'discipline_id' => $patinage->id,
            'tour_id'       => $tours[$patinage->id]['qualif']->id,
            'site_id'       => $assago->id,
            'jour'          => '2026-02-06',
            'heure_debut'   => '09:00',
            'heure_fin'     => '12:00',
            'prix'          => 35.00,
        ]);
        Competition::create([
            'discipline_id' => $patinage->id,
            'tour_id'       => $tours[$patinage->id]['finale']->id,
            'site_id'       => $assago->id,
            'jour'          => '2026-02-10',
            'heure_debut'   => '18:00',
            'heure_fin'     => '21:00',
            'prix'          => 75.00,
        ]);

        // Ski alpin
        Competition::create([
            'discipline_id' => $ski->id,
            'tour_id'       => $tours[$ski->id]['qualif']->id,
            'site_id'       => $stelvio->id,
            'jour'          => '2026-02-07',
            'heure_debut'   => '10:00',
            'heure_fin'     => '13:00',
            'prix'          => 40.00,
        ]);
        Competition::create([
            'discipline_id' => $ski->id,
            'tour_id'       => $tours[$ski->id]['finale']->id,
            'site_id'       => $stelvio->id,
            'jour'          => '2026-02-11',
            'heure_debut'   => '14:00',
            'heure_fin'     => '17:00',
            'prix'          => 80.00,
        ]);

        // Biathlon
        Competition::create([
            'discipline_id' => $biathlon->id,
            'tour_id'       => $tours[$biathlon->id]['qualif']->id,
            'site_id'       => $cortina->id,
            'jour'          => '2026-02-07',
            'heure_debut'   => '08:00',
            'heure_fin'     => '11:00',
            'prix'          => 30.00,
        ]);
        Competition::create([
            'discipline_id' => $biathlon->id,
            'tour_id'       => $tours[$biathlon->id]['finale']->id,
            'site_id'       => $cortina->id,
            'jour'          => '2026-02-12',
            'heure_debut'   => '10:00',
            'heure_fin'     => '13:00',
            'prix'          => 60.00,
        ]);

        // Bobsleigh
        Competition::create([
            'discipline_id' => $bobsleigh->id,
            'tour_id'       => $tours[$bobsleigh->id]['qualif']->id,
            'site_id'       => $mediolan->id,
            'jour'          => '2026-02-08',
            'heure_debut'   => '11:00',
            'heure_fin'     => '14:00',
            'prix'          => 25.00,
        ]);
        Competition::create([
            'discipline_id' => $bobsleigh->id,
            'tour_id'       => $tours[$bobsleigh->id]['finale']->id,
            'site_id'       => $mediolan->id,
            'jour'          => '2026-02-13',
            'heure_debut'   => '15:00',
            'heure_fin'     => '18:00',
            'prix'          => 55.00,
        ]);

        // Hockey sur glace
        Competition::create([
            'discipline_id' => $hockey->id,
            'tour_id'       => $tours[$hockey->id]['qualif']->id,
            'site_id'       => $verona->id,
            'jour'          => '2026-02-09',
            'heure_debut'   => '16:00',
            'heure_fin'     => '19:00',
            'prix'          => 45.00,
        ]);
        Competition::create([
            'discipline_id' => $hockey->id,
            'tour_id'       => $tours[$hockey->id]['finale']->id,
            'site_id'       => $verona->id,
            'jour'          => '2026-02-14',
            'heure_debut'   => '19:00',
            'heure_fin'     => '22:00',
            'prix'          => 90.00,
        ]);
    }
}