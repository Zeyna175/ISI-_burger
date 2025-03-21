@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold text-center text-green-600">🍔 Menu des Burgers</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            @foreach($burgers as $burger)
                <div class="bg-white p-4 shadow-lg rounded-lg">
                    <img src="{{ asset('storage/' . $burger->image) }}" alt="{{ $burger->nom }}" class="w-full h-40 object-cover rounded">
                    <h2 class="text-lg font-bold mt-2">{{ $burger->nom }}</h2>
                    <p class="text-gray-700">{{ $burger->description }}</p>
                    <p class="font-semibold mt-1">💰 {{ $burger->prix }} €</p>
                    <p class="font-semibold mt-1">Stock : {{ $burger->stock }}</p>

                    @if($burger->stock > 0)
                        <form action="{{ route('order.store') }}" method="POST" class="mt-3">
                            @csrf
                            <input type="hidden" name="burger_id" value="{{ $burger->id }}">
                            <input type="number" name="quantite" value="1" min="1" max="{{ $burger->stock }}" class="border rounded p-1 w-full">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full mt-2">🛒 Commander</button>
                        </form>
                    @else
                        <button class="bg-red-500 text-white px-4 py-2 rounded w-full mt-2" disabled>⛔ En rupture de stock</button>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection