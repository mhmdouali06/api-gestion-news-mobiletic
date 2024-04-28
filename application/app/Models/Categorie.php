<?php

namespace App\Models;

use App\Models\News;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorie extends Model
{
    protected $fillable=['Nom','parent_id'];

    public function news(){
        return $this->hasMany(News::class);
    }
    public function parent(){
        return $this->belongsTo(Categorie::class,'parent_id');
    }
    public function children(){
        return $this->hasMany(Categorie::class,'parent_id');
    }

    use HasFactory;
    
}
