<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       
    Schema::create('commandes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Lien avec l'utilisateur qui passe la commande
        $table->foreignId('burger_id')->constrained()->onDelete('cascade'); // Lien avec le burger commandé
        $table->integer('quantite')->default(1);
        $table->decimal('total', 8, 2);
        $table->enum('statut', ['en attente', 'en préparation', 'validée', 'expédiée', 'livrée'])->default('en attente');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
