<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Incident;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class IncidentController extends Controller
{
    /**
     * Affiche une liste paginée de tous les incidents.
     */
    public function index(): View
    {
        $incidents = Incident::with('child', 'user')->latest()->paginate(15);
        return view('incidents.index', compact('incidents'));
    }

    /**
     * Affiche le formulaire de création d'un nouvel incident.
     */
    public function create(): View
    {
        $user = Auth::user();
        
        // Si l'utilisateur est un administrateur ou un directeur, il peut voir tous les enfants.
        if ($user->role === 'admin' || $user->role === 'directeur') {
            $children = Child::orderBy('last_name')->get();
        } 
        // Sinon, c'est un moniteur, il ne voit que les enfants de son groupe.
        else {
            $children = $user->group ? $user->group->children()->orderBy('last_name')->get() : collect();
        }

        return view('incidents.create', compact('children'));
    }

    /**
     * Enregistre un nouvel incident dans la base de données.
     */
        public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'child_id' => 'required|exists:children,id',
            'type' => 'required|in:médical,disciplinaire',
            'incident_date' => 'required|date',
            'description' => 'required|string|max:1000',
        ]);

        $incident = Incident::create([
            'child_id' => $request->child_id,
            'user_id' => Auth::id(),
            'type' => $request->type,
            'incident_date' => $request->incident_date,
            'description' => $request->description,
            'status' => 'ouvert', // Statut par défaut
        ]);

        // Si l'incident est de type médical, on envoie un SMS à l'infirmier
        if ($incident->type === 'médical') {
            try {
                $nurse = User::where('role', 'infirmier')->first();

                if ($nurse && $nurse->phone_number) {
                    $twilio = new Client(config('twilio.sid'), config('twilio.token'));

                    $child = Child::find($incident->child_id);
                    $childName = $child ? $child->first_name . ' ' . $child->last_name : 'Enfant inconnu';

                                        $message = "[ColoPilot] Alerte incident médical pour : " . $childName . ". Description : " . $incident->description . ". Consultez le tableau de bord.";

                    $twilio->messages->create(
                        $nurse->phone_number,
                        [
                            'from' => config('twilio.from'),
                            'body' => $message,
                        ]
                    );
                }
            } catch (\Exception $e) {
                // Log l'erreur mais ne bloque pas le flux de l'utilisateur
                Log::error('Erreur envoi SMS Twilio : ' . $e->getMessage());
            }
        }

        return redirect()->route('dashboard')->with('success', 'Incident signalé avec succès.');
    }

    /**
     * Affiche les détails d'un incident spécifique.
     */
    public function show(Incident $incident): View
    {
        $incident->load('child', 'user'); // Assure que les relations sont chargées
        return view('incidents.show', compact('incident'));
    }

    /**
     * Met à jour un incident existant.
     */
    public function update(Request $request, Incident $incident): RedirectResponse
    {
        $request->validate([
            'follow_up' => 'nullable|string|max:2000',
            'status' => 'required|in:ouvert,fermé',
        ]);

        $incident->update([
            'follow_up' => $request->follow_up,
            'status' => $request->status,
        ]);

        return redirect()->route('incidents.show', $incident)->with('success', 'Incident mis à jour avec succès.');
    }
}
