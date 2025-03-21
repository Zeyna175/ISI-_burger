@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold text-green-600">🛒 Passer une Commande</h1>

        <form action="{{ route('commandes.store') }}" method="POST" class="mt-4">
            @csrf

            <div class="mb-4">
                <label for="burger_id" class="block font-bold">Sélectionnez un burger :</label>
                <select id="burger_id" name="burger_id" class="w-full border rounded p-2" required>
                    @foreach($burgers as $burger)
                        <option value="{{ $burger->id }}">{{ $burger->nom }} - {{ $burger->prix }} €</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="quantite" class="block font-bold">Quantité :</label>
                <input type="number" id="quantite" name="quantite" class="w-full border rounded p-2" min="1" required>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">✅ Commander</button>
        </form>
    </div>
@endsection