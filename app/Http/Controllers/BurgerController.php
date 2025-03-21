<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Burger;

use Illuminate\Support\Facades\Storage;

class BurgerController extends Controller
{
     // Afficher tous les burgers
     public function index()
     {
        $burgers = Burger::all();
        return view('burgers.index', compact('burgers'));
     }
 
     // Afficher le formulaire d'ajout de burger
     public function create()
     {
         return view('burgers.create');
     }
 
     // Enregistrer un nouveau burger
     public function store(Request $request)
     {
         $request->validate([
             'nom' => 'required|string|max:255',
             'prix' => 'required|numeric',
             'stock' => 'required|integer|min:0',
             'image' => 'nullable|image|max:2048'
         ]);
 
         $burger = new Burger([
             'nom' => $request->nom,
             'prix' => $request->prix,
             'stock' => $request->stock,
         ]);
 
         if ($request->hasFile('image')) {
             $burger->image = $request->file('image')->store('burgers', 'public');
         }
 
         $burger->save();
 
         return redirect()->route('burgers.index')->with('success', 'Burger ajouté avec succès');
     }
 
     // Afficher le formulaire de modification
     public function edit(Burger $burger)
     {
         return view('burgers.edit', compact('burger'));
     }
 
     // Mettre à jour un burger
     public function update(Request $request, Burger $burger)
     {
         $request->validate([
             'nom' => 'required|string|max:255',
             'prix' => 'required|numeric',
             'stock' => 'required|integer|min:0',
             'image' => 'nullable|image|max:2048'
         ]);
 
         // Mise à jour des informations du burger
         $burger->nom = $request->nom;
         $burger->prix = $request->prix;
         $burger->stock = $request->stock;
 
         // Gestion de l'image
         if ($request->hasFile('image')) {
             if ($burger->image) {
                 Storage::disk('public')->delete($burger->image);
             }
             $burger->image = $request->file('image')->store('burgers', 'public');
         }
 
         $burger->save();
 
         return redirect()->route('burgers.index')->with('success', 'Burger mis à jour avec succès');
     }
 
     // Supprimer un burger
     public function destroy(Burger $burger)
     {
         if ($burger->image) {
             Storage::disk('public')->delete($burger->image);
         }
 
         $burger->delete();
         return redirect()->route('burgers.index')->with('success', 'Burger supprimé avec succès');
     }
 }
 