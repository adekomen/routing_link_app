<?php

namespace App\Http\Controllers;

use App\Models\Lien;
use App\Models\Routeur;
use Illuminate\Http\Request;

class LienController extends Controller
{
    public function index()
    {
        // Récupérer tous les routeurs pour les afficher
        $routeurs = Routeur::all();
        return view('liens.index', compact('routeurs'));
    }

    public function store(Request $request)
    {
        // Validation des données d'entrée
        $request->validate([
            'routeur1_id' => 'required|exists:routeurs,id',
            'routeur2_id' => 'required|exists:routeurs,id|different:routeur1_id',
            'cout' => 'required|integer|min:1',
            'reseau' => 'nullable|string|max:255',
        ]);

        // Création d'un nouvel enregistrement de lien
        Lien::create([
            'routeur1_id' => $request->routeur1_id,
            'routeur2_id' => $request->routeur2_id,
            'cout' => $request->cout,
            'reseau' => $request->reseau,
        ]);

        // Redirection avec message de succès
        return redirect()->route('liens.index')->with('success', 'Le lien a été ajouté avec succès !');
    }

    public function showAll()
    {
        // Récupère tous les liens avec les informations des routeurs associés
        $liens = Lien::with(['routeur1', 'routeur2'])->get();

        return view('liens.showAll', compact('liens'));
    }

    public function edit($id)
    {
        $lien = Lien::findOrFail($id);
        $routeurs = Routeur::all();
        return view('liens.edit', compact('lien', 'routeurs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'routeur1_id' => 'required|exists:routeurs,id',
            'routeur2_id' => 'required|exists:routeurs,id|different:routeur1_id',
            'cout' => 'required|integer|min:1',
            'reseau' => 'nullable|string|max:255',
        ]);

        $lien = Lien::findOrFail($id);
        $lien->update($request->only(['routeur1_id', 'routeur2_id', 'cout', 'reseau']));

        return redirect()->route('liens.showAll')->with('success', 'Le lien a été mis à jour avec succès !');
    }

    public function destroy($id)
    {
        $lien = Lien::findOrFail($id);
        $lien->delete();

        return redirect()->route('liens.showAll')->with('success', 'Le lien a été supprimé avec succès !');
    }

    public function create()
    {
        $routeurs = Routeur::all(); // Récupère tous les routeurs
        return view('liens.create', compact('routeurs'));
    }


}
