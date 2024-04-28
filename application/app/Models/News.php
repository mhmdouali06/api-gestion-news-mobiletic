<?php

namespace App\Models;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    protected $fillable = [
        'Titre',
        'Contenu',
        'categorie_id',
        'Date_debut',
        'Date_fin', 
    ];
    use HasFactory;
    public function categorie(){
        return $this->belongsTo(Categorie::class,'categorie_id');
    }
}
