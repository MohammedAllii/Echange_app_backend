<?php
// App\Models\Productsoffre.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Productsoffre extends Pivot
{
    use HasFactory;

    protected $table = 'productsoffre';

    protected $fillable = [
        'produit_id',
        'offre_id',
    ];

    public function offre()
    {
        return $this->belongsTo(Offre::class, 'offre_id');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }
}
