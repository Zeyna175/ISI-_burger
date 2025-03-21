<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Burger extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'description', 'prix', 'image', 'stock'];
    

// Vérifie si le burger est en stock
public function estDisponible()
{
    return $this->stock > 0;
}

}

