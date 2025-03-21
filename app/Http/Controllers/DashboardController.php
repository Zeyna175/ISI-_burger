<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\Burger;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 📦 Commandes totales
        $totalCommandes = Commande::count();

        // ✅ Commandes validées aujourd’hui
        $commandesValideesJour = Commande::whereDate('updated_at', Carbon::today())
                                          ->where('statut', 'validée')
                                          ->count();

        // 🚚 Commandes en cours aujourd’hui
        $commandesEnCoursJour = Commande::whereDate('created_at', Carbon::today())
                                        ->whereIn('statut', ['en attente', 'validée'])
                                        ->count();

        // 💰 Recettes journalières (total des paiements reçus)
        $recettesJournalieres = Commande::whereDate('updated_at', Carbon::today())
                                        ->where('statut_paiement', 'payé')
                                        ->sum('total');

        // 📅 Nombre de commandes par mois
        $commandesParMois = Commande::select(DB::raw("COUNT(id) as count"), DB::raw("MONTHNAME(created_at) as month"))
                                    ->groupBy('month')
                                    ->orderByRaw("STR_TO_DATE(month, '%M')")
                                    ->pluck('count', 'month');

        // 🍔 Nombre de burgers par catégorie par mois
        $produitsParCategorieMois = Burger::select(DB::raw("COUNT(id) as count"), DB::raw("MONTHNAME(created_at) as month"))
                                          ->groupBy('month')
                                          ->orderByRaw("STR_TO_DATE(month, '%M')")
                                          ->pluck('count', 'month');

        return view('dashboard', compact(
            'totalCommandes',
            'commandesValideesJour',
            'commandesEnCoursJour',
            'recettesJournalieres',
            'commandesParMois',
            'produitsParCategorieMois'
        ));
    }
}