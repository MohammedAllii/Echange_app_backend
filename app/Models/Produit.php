<?php
// App\Models\Produit.php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produit extends Model
{
    use HasFactory;

    protected $table = 'produits';

    protected $fillable = [
        'nom_produit',
        'description',
        'status',
        'visibility',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(ImageProduit::class, 'produit_id', 'unique_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function favoris()
    {
        return $this->hasMany(Favoris::class);
    }

}

