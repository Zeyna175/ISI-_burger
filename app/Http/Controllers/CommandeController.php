<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Commande;
use App\Models\Burger;

class CommandeController extends Controller
{
    // Afficher toutes les commandes (uniquement pour l'admin/gestionnaire)
    public function index()
    {
        $commandes = Commande::with('user', 'burger')->get();
        return view('commandes.index', compact('commandes'));
    }

    // Afficher le formulaire de commande (pour les clients)
    public function create()
    {
        $burgers = Burger::where('stock', '>', 0)->get();

        if ($burgers->isEmpty()) {
            return "Aucun burger disponible en stock."; // Test temporaire
        }

        return view('commandes.create', compact('burgers'));
    }

    // Enregistrer une nouvelle commande
    public function store(Request $request)
    {
        $request->validate([
            'burger_id' => 'required|exists:burgers,id',
            'quantite' => 'required|integer|min:1'
        ]);

        $burger = Burger::findOrFail($request->burger_id);

        // Vérifier le stock
        if ($burger->stock < $request->quantite) {
            return redirect()->back()->with('error', 'Stock insuffisant pour ce burger.');
        }

        // Réduire le stock après la commande
        $burger->stock -= $request->quantite;
        $burger->save();

        // Enregistrer la commande
        Commande::create([
            'user_id' => Auth::id(),
            'burger_id' => $request->burger_id,
            'quantite' => $request->quantite,
            'total' => $burger->prix * $request->quantite,
            'statut' => 'en attente',
        ]);

        return redirect()->route('menu')->with('success', 'Commande passée avec succès !');
    }

    // Mettre à jour le statut de la commande (gestionnaire)
    public function update(Request $request, Commande $commande)
    {
        $request->validate([
            'statut' => 'required|in:en attente,validée,expédiée,livrée'
        ]);

        $commande->update(['statut' => $request->statut]);

        return redirect()->route('commandes.index')->with('success', 'Statut mis à jour avec succès.');
    }
//Modifier
       public function edit(Commande $commande)
            {
                 return view('commandes.edit', compact('commande'));
           } 

    // Supprimer une commande
    public function destroy(Commande $commande)
    {
        $commande->delete();
        return redirect()->back()->with('success', 'Commande supprimée avec succès.');
    }

    public function payer(Commande $commande)
{

    // Vérification si la commande existe bien

    if (!$commande) {
        return redirect()->back()->with('error', 'Commande introuvable.');
    }

    // Mise à jour du statut de paiement
    $commande->update(['statut_paiement' => 'payé']);

    return redirect()->route('commandes.index')->with('success', 'Paiement effectué avec succès.');
}


public function updateLivraison(Request $request, Commande $commande)
{
    $request->validate([
        'statut_livraison' => 'required|in:en attente,en cours,livrée'
    ]);

    $commande->update(['statut_livraison' => $request->statut_livraison]);

    return redirect()->route('commandes.index')->with('success', 'Statut de livraison mis à jour avec succès.');
}

}

