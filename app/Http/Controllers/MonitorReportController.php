<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MonitorReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MonitorReportController extends Controller
{
    /**
     * Affiche le formulaire pour créer un nouveau rapport de moniteur.
     */
    public function create()
    {
        // Récupérer uniquement les utilisateurs avec le rôle 'moniteur'
        $monitors = User::where('role', 'moniteur')->orderBy('name')->get();

        // Passer la liste des moniteurs à la vue
        return view('monitor-report.create', ['monitors' => $monitors]);
    }

    /**
     * Stocke un nouveau rapport de moniteur dans la base de données.
     */
    public function store(Request $request)
    {
        // 1. Valider le code du jour
        if ($request->input('code_du_jour') !== self::getCodeDuJour()) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['code_du_jour' => 'Le code du jour est incorrect.']);
        }

        // 2. Valider le reste des données
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'q1_dispositif' => 'nullable|string|max:2048',
            'q1_voyage' => 'nullable|string|max:2048',
            'q2_organisation' => 'nullable|string|max:2048',
            'q2_ameliorations' => 'nullable|string|max:2048',
            'q2_repartition_groupes' => 'nullable|string|max:2048',
            'q2_referents' => 'nullable|string|max:2048',
            'q2_rythme_activites' => 'nullable|string|max:2048',
            'q3_relations_moniteurs' => 'nullable|string|max:2048',
            'q3_relations_enfants' => 'nullable|string|max:2048',
            'q3_relations_moniteurs_enfants' => 'nullable|string|max:2048',
            'q4_hebergement' => 'nullable|string|max:2048',
            'q4_restauration' => 'nullable|string|max:2048',
            'q5_suggestions' => 'nullable|string',
        ]);

        // 3. Vérifier que l'utilisateur est bien un moniteur
        $monitor = User::find($validatedData['user_id']);
        if (!$monitor || $monitor->role !== 'moniteur') {
            return redirect()->back()
                ->withInput()
                ->withErrors(['user_id' => 'L\'utilisateur sélectionné n\'est pas un moniteur valide.']);
        }

        // 4. Créer le rapport
        MonitorReport::create($validatedData);

        // 5. Rediriger avec un message de succès
        return redirect()->route('monitor-report.create')->with('success', 'Votre rapport a bien été soumis ! Merci pour votre contribution.');
    }

    /**
     * Affiche la liste de tous les rapports pour les administrateurs.
     */
    public function index()
    {
        // La logique pour récupérer et afficher tous les rapports viendra ici.
        $reports = MonitorReport::with('user')->latest()->get();
        return view('monitor-report.index', ['reports' => $reports]);
    }

    /**
     * Génère le code du jour basé sur la date et une clé secrète.
     */
    public static function getCodeDuJour()
    {
        $secretKey = config('app.key'); // Utilise la clé de l'application pour la sécurité
        $date = date('Y-m-d');
        // Crée un hash, le convertit en nombre et prend les 4 premiers chiffres
        $hash = substr(preg_replace('/[^0-9]/', '', crc32($date . $secretKey)), 0, 4);
        
        // S'assure que le code a toujours 4 chiffres, même s'il commence par 0
        return str_pad($hash, 4, '0', STR_PAD_LEFT);
    }
}