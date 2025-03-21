@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold text-blue-600">📦 Liste des Commandes</h1>

        <table class="table-auto w-full mt-4">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">Client</th>
                    <th class="px-4 py-2">Burger</th>
                    <th class="px-4 py-2">Quantité</th>
                    <th class="px-4 py-2">Statut</th>
                    <th class="px-4 py-2">Paiement</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commandes as $commande)
                    <tr>
                        <td class="border px-4 py-2">{{ $commande->user->name ?? 'Utilisateur inconnu' }}</td>
                        <td class="border px-4 py-2">{{ $commande->burger->nom ?? 'Burger supprimé' }}</td>
                        <td class="border px-4 py-2">{{ $commande->quantite }}</td>
                        <td class="border px-4 py-2">
                            <form action="{{ route('commandes.update', $commande) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="statut" onchange="this.form.submit()" class="border rounded p-1">
                                    <option value="en attente" {{ $commande->statut == 'en attente' ? 'selected' : '' }}>En attente</option>
                                    <option value="validée" {{ $commande->statut == 'validée' ? 'selected' : '' }}>Validée</option>
                                    <option value="expédiée" {{ $commande->statut == 'expédiée' ? 'selected' : '' }}>Expédiée</option>
                                    <option value="livrée" {{ $commande->statut == 'livrée' ? 'selected' : '' }}>Livrée</option>
                                </select>
                            </form>
                        </td>
                        <td class="border px-4 py-2">
                            {{ ucfirst($commande->statut_paiement) }}
                        </td>
                        <td class="border px-4 py-2">
                            <div class="flex space-x-2">
                                @if($commande->statut_paiement == 'en attente')
                                    <form action="{{ route('commandes.payer', $commande) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded">💳 Payer</button>
                                    </form>
                                @endif
                                
                                <a href="{{ route('commandes.edit', ['commande' => $commande->id]) }}" class="text-blue-500">✏ Modifier</a>

                                <form action="{{ route('commandes.destroy', $commande) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">🗑 Supprimer</button>
                                </form>
                            </div>
                        </td>
                        <th class="px-4 py-2">Livraison</th>
                        <td class="border px-4 py-2">
    <form action="{{ route('commandes.livraison', $commande) }}" method="POST">
        @csrf
        @method('PATCH')
        <select name="statut_livraison" onchange="this.form.submit()" class="border rounded p-1">
            <option value="en attente" {{ $commande->statut_livraison == 'en attente' ? 'selected' : '' }}>En attente</option>
            <option value="en cours" {{ $commande->statut_livraison == 'en cours' ? 'selected' : '' }}>En cours</option>
            <option value="livrée" {{ $commande->statut_livraison == 'livrée' ? 'selected' : '' }}>Livrée</option>
        </select>
    </form>
</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection



