<?php

namespace App\Http\Controllers;

use App\Models\Lien;
use App\Models\Routeur;
use Illuminate\Http\Request;

class SpfController extends Controller
{
    public function calculerSPF($sourceId)
    {
        $routeurs = Routeur::all();
        $liens = Lien::all();

        if ($routeurs->isEmpty() || $liens->isEmpty()) {
            return response()->json(['error' => 'Aucun routeur ou lien trouvé dans la base de données'], 404);
        }

        // Initialisation des distances et des prédécesseurs
        $distances = [];
        $predecesseurs = [];
        foreach ($routeurs as $routeur) {
            $distances[$routeur->id] = INF;
            $predecesseurs[$routeur->id] = null;
        }
        $distances[$sourceId] = 0;

        // Ensemble des nœuds non visités
        $nonVisites = $distances;

        while (!empty($nonVisites)) {
            $minNode = array_search(min($nonVisites), $nonVisites);
            unset($nonVisites[$minNode]);

            foreach ($liens as $lien) {
                if ($lien->routeur1_id == $minNode || $lien->routeur2_id == $minNode) {
                    $voisinId = ($lien->routeur1_id == $minNode) ? $lien->routeur2_id : $lien->routeur1_id;
                    $nouvelleDistance = $distances[$minNode] + $lien->cout;

                    if ($nouvelleDistance < $distances[$voisinId]) {
                        $distances[$voisinId] = $nouvelleDistance;
                        $predecesseurs[$voisinId] = $minNode;
                        $nonVisites[$voisinId] = $nouvelleDistance;
                    }
                }
            }
        }

        // Génération des chemins les plus courts et préparation pour le JSON
        $chemins = [];
        foreach ($routeurs as $routeur) {
            if ($routeur->id != $sourceId) {
                $chemin = [];
                $current = $routeur->id;
                while ($current != null) {
                    $cheminNom = Routeur::find($current)->nom;
                    array_unshift($chemin, $cheminNom);
                    $current = $predecesseurs[$current];
                }
                $cout = $distances[$routeur->id] === INF ? "Inaccessible" : $distances[$routeur->id];

                $chemins[] = [
                    'destination_nom' => $routeur->nom,
                    'destination_reseau' => $routeur->reseau,
                    'chemin' => implode(' → ', $chemin),
                    'cout' => $cout
                ];
            }
        }

        return response()->json($chemins);
    }


    public function visualiserReseau()
    {
        // Récupérer les routeurs et les liens
        $routeurs = Routeur::all();
        $liens = Lien::all();

        // Préparer les données pour le graphique
        $nodes = $routeurs->map(function($routeur) {
            return [
                'id' => $routeur->id,
                'nom' => $routeur->nom,
            ];
        });

        $edges = $liens->map(function($lien) {
            return [
                'source' => $lien->routeur1_id,
                'target' => $lien->routeur2_id,
                'cout' => $lien->cout,
                'reseau' => $lien->reseau,
            ];
        });

        // Passer les données à la vue pour le rendu graphique
        return view('spf.graph', compact('nodes', 'edges'));
    }
}