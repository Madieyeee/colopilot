<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Wish;

class FeedbackController extends Controller
{
    /**
     * Affiche la liste des avis et des souhaits pour les administrateurs.
     */
    public function index()
    {
        $reviews = Review::with('child')->latest()->get();
        $wishes = Wish::with('child')->latest()->get();

        return view('feedback.index', compact('reviews', 'wishes'));
    }

    /**
     * Affiche le formulaire pour laisser un avis ou un souhait.
     */
    public function create()
    {
        $children = \App\Models\Child::orderBy('first_name')->get();
        return view('feedback.create', compact('children'));
    }

    /**
     * Enregistre un nouvel avis ou souhait dans la base de données.
     */
    public function store(Request $request)
    {
        $request->validate([
            'child_id' => 'required|exists:children,id',
            'feedback_type' => 'required|in:review,wish',
        ]);

        if ($request->input('feedback_type') === 'review') {
            $request->validate([
                'activity_name' => 'required|string|max:255',
                'rating' => 'required|integer|min:1|max:5',
                'comment' => 'nullable|string',
            ]);

            \App\Models\Review::create([
                'child_id' => $request->input('child_id'),
                'activity_name' => $request->input('activity_name'),
                'rating' => $request->input('rating'),
                'comment' => $request->input('comment'),
            ]);

        } elseif ($request->input('feedback_type') === 'wish') {
            $request->validate([
                'wish_category' => 'required|string|max:255',
                'wish_description' => 'required|string',
            ]);

            \App\Models\Wish::create([
                'child_id' => $request->input('child_id'),
                'category' => $request->input('wish_category'),
                'description' => $request->input('wish_description'),
            ]);
        }

        return redirect()->route('feedback.create')->with('success', 'Merci ! Ton message a bien été envoyé.');
    }
}
