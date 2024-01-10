<?php
// App\Models\Offre.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Offre extends Model
{
    use HasFactory;

    protected $table = 'offres';

    protected $fillable = [
        'user_id',
        'produitcible_id',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function produitcible()
    {
        return $this->belongsTo(Produit::class, 'produitcible_id');
    }

    public function productsOffre()
    {
        return $this->hasMany(Productsoffre::class, 'offre_id');
    }
}
