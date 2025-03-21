<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'burger_id', 'quantite', 'total', 'statut', 'statut_paiement'];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec le burger
    public function burger()
    {
        return $this->belongsTo(Burger::class);
    }
}
