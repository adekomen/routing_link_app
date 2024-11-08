<?php

namespace App\Http\Controllers;

use App\Models\Lien;
use App\Models\Routeur;
use Illuminate\Http\Request;

class RouteurController extends Controller
{
    public function index()
    {
        return view('routeurs.index');
    }

    public function store(Request $request)
    {
        $nombreRouteurs = $request->input('nombre_routeurs');

        // Valide que le nombre de routeurs est un entier positif
        $request->validate([
            'nombre_routeurs' => 'required|integer|min:1',
        ]);

        return view('routeurs.create', compact('nombreRouteurs'));
    }

    public function storeFinal(Request $request)
    {
        // Récupérer les données des routeurs
        $data = $request->input('routeurs');

        // Supprimer tous les anciens routeurs et liens
        Lien::query()->delete();
        Routeur::query()->delete();

        // Créer les nouveaux routeurs
        foreach ($data as $routeurData) {
            Routeur::create([
                'nom' => $routeurData['nom'],
                'reseau' => $routeurData['reseau'],
            ]);
        }

        return redirect()->route('liens.index')->with('success', 'Les routeurs ont été ajoutés avec succès !');
    }

}
