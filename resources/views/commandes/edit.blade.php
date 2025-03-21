@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold text-blue-600">📝 Modifier la Commande</h1>

        <form action="{{ route('commandes.update', $commande->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <label class="block mt-4">Statut :</label>
            <select name="statut" class="border rounded p-2">
                <option value="en attente" {{ $commande->statut == 'en attente' ? 'selected' : '' }}>En attente</option>
                <option value="validée" {{ $commande->statut == 'validée' ? 'selected' : '' }}>Validée</option>
                <option value="expédiée" {{ $commande->statut == 'expédiée' ? 'selected' : '' }}>Expédiée</option>
                <option value="livrée" {{ $commande->statut == 'livrée' ? 'selected' : '' }}>Livrée</option>
            </select>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">✅ Mettre à jour</button>
        </form>
    </div>
@endsection