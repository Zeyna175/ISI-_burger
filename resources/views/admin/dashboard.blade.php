@extends('layouts.app') <!-- Hérite de la mise en page principale -->

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-center text-3xl font-bold text-blue-600">📌 Dashboard Administrateur</h1>

        <div class="bg-white p-6 mt-6 shadow-lg rounded-lg">
            <p class="text-lg text-gray-700">Bienvenue sur l'interface d'administration.</p>

            <ul class="mt-4 space-y-2 text-gray-800">
                <li class="flex items-center">
                    <i class="fas fa-hamburger text-yellow-500 mr-2"></i> <strong>⚡Gérer les produits</strong> (burgers, boissons, etc.)
                </li>
                <li class="flex items-center">
                    <i class="fas fa-shopping-cart text-green-500 mr-2"></i> <strong>📦Gérer les commandes</strong>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-chart-line text-red-500 mr-2"></i> <strong>📊Voir les statistiques des ventes</strong>
                </li>
            </ul>
        </div>
    </div>
@endsection