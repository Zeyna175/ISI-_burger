<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Burger;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'burger_id' => 'required|exists:burgers,id',
            'quantite' => 'required|integer|min:1'
        ]);

        $burger = Burger::findOrFail($request->burger_id);

        // Vérifier si le burger est en stock 
        if ($burger->stock < $request->quantite) {
            return redirect()->back()->with('error', 'Stock insuffisant pour ce burger.');
        }

        // Réduire le stock après la commande
        $burger->stock -= $request->quantite;
        $burger->save();

        // Enregistrer la commande (ajoute ici la logique pour enregistrer la commande)
        
        return redirect()->route('menu')->with('success', 'Commande passée avec succès !');
    }
}
