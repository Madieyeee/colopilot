<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $childrenQuery = Child::with('group')
            ->leftJoin('groups', 'children.group_id', '=', 'groups.id')
            ->select('children.*') // Important pour éviter les collisions de noms de colonnes
            ->orderByRaw('ISNULL(groups.name), groups.name ASC') // Trie par groupe, en plaçant les non-assignés à la fin
            ->orderBy('children.last_name', 'asc');

        if ($search) {
            $childrenQuery->where(function ($query) use ($search) {
                $query->where('children.first_name', 'like', "%{$search}%")
                      ->orWhere('children.last_name', 'like', "%{$search}%");
            });
        }

        $children = $childrenQuery->get();

        return view('children.index', [
            'children' => $children,
            'search' => $search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
