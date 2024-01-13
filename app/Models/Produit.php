<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $fillable = [
   
        'name',
        'description',
        'image_path',
        'categorie_id',
        'stock',
        'prix',
    ];
    public function categorie(){
        return $this->belongsTo(Categorie::class,'categorie_id','id');
    }
}
