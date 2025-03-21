@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-blue-600">📊 Tableau de bord</h1>

    <!-- ✅ Statistiques générales -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
        <div class="p-6 bg-white shadow rounded-lg">
            <h2 class="text-xl font-semibold text-gray-700">📦 Commandes totales</h2>
            <p class="text-2xl font-bold text-blue-500">{{ $totalCommandes }}</p>
        </div>

        <div class="p-6 bg-white shadow rounded-lg">
            <h2 class="text-xl font-semibold text-gray-700">✅ Commandes validées aujourd’hui</h2>
            <p class="text-2xl font-bold text-green-500">{{ $commandesValideesJour }}</p>
        </div>

        <div class="p-6 bg-white shadow rounded-lg">
            <h2 class="text-xl font-semibold text-gray-700">🚚 Commandes en cours aujourd’hui</h2>
            <p class="text-2xl font-bold text-yellow-500">{{ $commandesEnCoursJour }}</p>
        </div>

        <div class="p-6 bg-white shadow rounded-lg">
            <h2 class="text-xl font-semibold text-gray-700">💰 Recettes journalières</h2>
            <p class="text-2xl font-bold text-green-500">{{ number_format($recettesJournalieres, 2) }} €</p>
        </div>
    </div>

    <!-- 📊 Nombre de commandes par mois -->
    <div class="mt-8 bg-white p-6 shadow-lg rounded-lg">
        <h2 class="text-xl font-bold text-gray-700">📅 Commandes par mois</h2>
        <canvas id="commandesParMoisChart"></canvas>
    </div>

    <!-- 🍔 Nombre de produits par catégorie par mois -->
    <div class="mt-8 bg-white p-6 shadow-lg rounded-lg">
        <h2 class="text-xl font-bold text-gray-700">🍔 Produits ajoutés par mois</h2>
        <canvas id="produitsParCategorieChart"></canvas>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // 📊 Commandes par mois
        const ctxCommandes = document.getElementById('commandesParMoisChart').getContext('2d');
        const commandesParMoisChart = new Chart(ctxCommandes, {
            type: 'line',
            data: {
                labels: {!! json_encode($commandesParMois->keys()) !!},
                datasets: [{
                    label: 'Commandes par Mois',
                    data: {!! json_encode($commandesParMois->values()) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
                }]
            }
        });

        // 🍔 Produits par catégorie par mois
        const ctxProduits = document.getElementById('produitsParCategorieChart').getContext('2d');
        const produitsParCategorieChart = new Chart(ctxProduits, {
            type: 'bar',
            data: {
                labels: {!! json_encode($produitsParCategorieMois->keys()) !!},
                datasets: [{
                    label: 'Produits par Mois',
                    data: {!! json_encode($produitsParCategorieMois->values()) !!},
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2
                }]
            }
        });
    });
</script>
@endsection