@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold text-blue-600">📦 Mes Commandes</h1>

        <table class="table-auto w-full mt-4">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">Burger</th>
                    <th class="px-4 py-2">Quantité</th>
                    <th class="px-4 py-2">Total</th>
                    <th class="px-4 py-2">Statut</th>
                    <th class="px-4 py-2">Paiement</th>
                    <th class="px-4 py-2">Livraison</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commandes as $commande)
                    <tr>
                        <td class="border px-4 py-2">{{ $commande->burger->nom ?? 'Burger supprimé' }}</td>
                        <td class="border px-4 py-2">{{ $commande->quantite }}</td>
                        <td class="border px-4 py-2">{{ number_format($commande->total, 2) }} €</td>
                        <td class="border px-4 py-2">{{ ucfirst($commande->statut) }}</td>
                        <td class="border px-4 py-2">{{ ucfirst($commande->statut_paiement) }}</td>
                        <td class="border px-4 py-2">{{ ucfirst($commande->statut_livraison) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($commandes->isEmpty())
    <p class="text-red-500">Aucune commande trouvée.</p>
@endif
@foreach($commandes as $commande)
    <p>Commande ID: {{ $commande->id }}, Statut: {{ $commande->statut }}</p>
@endforeach

@endsection