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
        // La logique de validation et de stockage viendra ici.
        // Pour l'instant, nous allons juste rediriger avec un message.
        return redirect()->route('monitor-report.create')->with('success', 'Votre rapport a bien été soumis ! Merci.');
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
    private function getCodeDuJour()
    {
        $secretKey = config('app.key'); // Utilise la clé de l'application pour la sécurité
        $date = date('Y-m-d');
        // Crée un hash, le convertit en nombre et prend les 4 premiers chiffres
        $hash = substr(preg_replace('/[^0-9]/', '', crc32($date . $secretKey)), 0, 4);
        
        // S'assure que le code a toujours 4 chiffres, même s'il commence par 0
        return str_pad($hash, 4, '0', STR_PAD_LEFT);
    }
}