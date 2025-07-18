<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MonitorReport;
use Illuminate\Http\Request;

class MonitorReportController extends Controller
{
    /**
     * Affiche le formulaire pour créer un nouveau rapport de moniteur.
     */
    public function create()
    {
        $monitors = User::where('role', 'moniteur')->orderBy('name')->get();
        return view('monitor-report.create', ['monitors' => $monitors]);
    }

    /**
     * Stocke un nouveau rapport de moniteur dans la base de données.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'code_du_jour' => 'required|string',
            'q1_projet_comprehension' => 'nullable|string',
            'q1_activites_adequation' => 'nullable|string',
            'q1_activites_equilibre' => 'nullable|string',
            'q1_activites_ressources' => 'nullable|string',
            'q1_activite_top' => 'nullable|string',
            'q1_activite_flop' => 'nullable|string',
            'q2_rythme_journee' => 'nullable|string',
            'q2_enfants_integration' => 'nullable|string',
            'q2_conflits_gestion' => 'nullable|string',
            'q2_participation_enfants' => 'nullable|string',
            'q3_equipe_accueil' => 'nullable|string',
            'q3_equipe_communication' => 'nullable|string',
            'q3_equipe_soutien_direction' => 'nullable|string',
            'q3_equipe_ambiance' => 'nullable|string',
            'q4_securite_respect' => 'nullable|string',
            'q4_hygiene_locaux' => 'nullable|string',
            'q4_restauration_qualite' => 'nullable|string',
            'q4_logistique_transport' => 'nullable|string',
            'q5_bilan_personnel' => 'nullable|string',
            'q5_suggestion_cle' => 'nullable|string',
            'q5_revenir' => 'nullable|string',
        ]);

        if ($validated['code_du_jour'] !== self::getCodeDuJour()) {
            return back()->withErrors(['code_du_jour' => 'Le code du jour est incorrect.'])->withInput();
        }

        $monitor = User::find($validated['user_id']);
        if (!$monitor || $monitor->role !== 'moniteur') {
            return back()->withErrors(['user_id' => 'Utilisateur invalide.'])->withInput();
        }

        MonitorReport::create($validated);

        return redirect()->route('monitor-report.create')->with('success', 'Votre rapport a été soumis avec succès. Merci pour votre précieuse contribution !');
    }

    /**
     * Affiche la liste de tous les rapports pour les administrateurs.
     */
    public function index()
    {
        $reports = MonitorReport::with('user')->latest()->get();
        return view('monitor-report.index', ['reports' => $reports]);
    }

    /**
     * Affiche les détails d'un rapport de moniteur spécifique.
     */
    public function show(MonitorReport $report)
    {
        $report->load('user');
        return view('monitor-report.show', compact('report'));
    }

    /**
     * Génère le code du jour basé sur la date et une clé secrète.
     */
    public static function getCodeDuJour()
    {
        $secretKey = config('app.key');
        $date = date('Y-m-d');
        $hash = substr(preg_replace('/[^0-9]/', '', crc32($date . $secretKey)), 0, 4);
        return str_pad($hash, 4, '0', STR_PAD_LEFT);
    }
}
