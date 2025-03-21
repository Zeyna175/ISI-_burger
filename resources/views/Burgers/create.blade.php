@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold text-green-600">➕ Ajouter un Burger</h1>

        <form action="{{ route('burgers.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
            @csrf

            <div class="mb-4">
                <label for="nom" class="block font-bold">Nom du burger :</label>
                <input type="text" id="nom" name="nom" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block font-bold">Description :</label>
                <textarea id="description" name="description" class="w-full border rounded p-2"></textarea>
            </div>

            <div class="mb-4">
                <label for="prix" class="block font-bold">Prix (€) :</label>
                <input type="number" id="prix" name="prix" class="w-full border rounded p-2" step="0.01" required>
            </div>

            <div class="mb-4">
                <label for="stock" class="block font-bold">Stock :</label>
                <input type="number" id="stock" name="stock" class="w-full border rounded p-2" min="0" required>
            </div>

            <div class="mb-4">
                <label for="image" class="block font-bold">Image :</label>
                <input type="file" id="image" name="image" class="w-full border rounded p-2">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">✅ Enregistrer</button>
        </form>
    </div>
@endsection

