@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-center text-3xl font-bold text-green-600">👤 Espace Client</h1>

        <div class="bg-white p-6 mt-6 shadow-lg rounded-lg">
            <p class="text-lg text-gray-700">Bienvenue dans votre espace client. Ici, vous pouvez :</p>

            <ul class="mt-4 space-y-2 text-gray-800">
                <li class="flex items-center">
                    <i class="fas fa-utensils text-yellow-500 mr-2"></i> <strong>🍔Voir le menu et commander des burgers</strong>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-shopping-basket text-blue-500 mr-2"></i> <strong>🛒Suivre vos commandes</strong>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-file-invoice text-red-500 mr-2"></i> <strong>📄Télécharger vos factures</strong>
                </li>
            </ul>
        </div>
    </div>
@endsection

