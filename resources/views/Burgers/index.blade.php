@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold text-blue-600 text-center">🍔 Liste des Burgers</h1>

        <a href="{{ route('burgers.create') }}" class="bg-green-500 text-white px-4 py-2 rounded mt-4 inline-block">
            ➕ Ajouter un burger
        </a>

        <table class="table-auto w-full mt-4">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">Nom</th>
                    <th class="px-4 py-2">Prix</th>
                    <th class="px-4 py-2">Stock</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($burgers as $burger)
                    <tr>
                        <td class="border px-4 py-2">{{ $burger->nom }}</td>
                        <td class="border px-4 py-2">{{ $burger->prix }} €</td>
                        <td class="border px-4 py-2">
                            @if($burger->stock > 0)
                                <span class="text-green-600">{{ $burger->stock }} en stock</span>
                            @else
                                <span class="text-red-600">Rupture de stock</span>
                            @endif
                        </td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('burgers.edit', $burger->id) }}" class="text-blue-500">✏ Modifier</a>
                            
                            <form action="{{ route('burgers.destroy', $burger->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">🗑 Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
