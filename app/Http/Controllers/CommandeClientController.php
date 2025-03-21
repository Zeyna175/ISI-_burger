<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use Illuminate\Support\Facades\Auth;

class CommandeClientController extends Controller
{
    public function index()
    {
        // Récupérer les commandes du client connecté
        $commandes = Commande::where('user_id', Auth::id())->get();

        // Retourner la vue avec les commandes
        return view('commandes.client_index', compact('commandes'));
    }
}
